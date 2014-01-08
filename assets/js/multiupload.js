function multiUploader(config){
  
	this.config = config;
	this.items = "";
	this.all = []
	var self = this;
	
	multiUploader.prototype._init = function(){
		if (window.File && 
			window.FileReader && 
			window.FileList && 
			window.Blob) {		
			 var inputId = $("#"+this.config.form).find("input[type='file']").eq(0).attr("id");
			 document.getElementById(inputId).addEventListener("change", this._read, false);
			 document.getElementById(this.config.dragArea).addEventListener("dragover", function(e){ e.stopPropagation(); e.preventDefault(); }, false);
			 document.getElementById(this.config.dragArea).addEventListener("drop", this._dropFiles, false);
			 document.getElementById(this.config.form).addEventListener("submit", this._submit, false);
		} else
			console.log("Browser supports failed");
	}
	
	multiUploader.prototype._submit = function(e){
		e.stopPropagation(); e.preventDefault();
		self._startUpload();
	}
	multiUploader.prototype._preview = function(data){
		this.items = data;
		console.log(this.items.length);
		if(this.items.length > 0){
			var html = "";		
			var uId = "";
 			for(var i = 0; i<this.items.length; i++){
				uId = this.items[i].name._unique();
				console.log(uId);

				var sampleIcon = '<img src="http://chen.local/aquill/aq/aquill/storage/media/2014/01/image_1.jpg" />';
				var reader = new FileReader();
				reader.onload = function(e){
					console.log(uId);
					sampleIcon = '<img src="http://chen.local/aquill/aq/aquill/storage/media/2014/01/image_1.jpg" data="'+e.target.result+'" />';
				};
				//var sampleIcon = '<img src="http://chen.local/aquill/aq/aquill/storage/media/2014/01/image_1.jpg" />';
				var errorClass = "";
				if(typeof this.items[i] != undefined){
					if(self._validate(this.items[i].type) <= 0) {
						sampleIcon = '<img src="images/unknown.png" />';
						errorClass =" invalid";
					}
					html += '<div class="dfiles'+errorClass+'" rel="'+uId+'">'
						+sampleIcon
						+'<h3 class="icon-themes">'+this.items[i].name+'</h3>'
						+'<div id="'+uId+'" class="progress" style="display:none;"><img src="http://chen.local/aquill/aq/assets/ajax-loader.gif" /></div>'
						+'</div>';
				}
			}
			$("#dragAndDropFiles").prepend(html);
			        //$('.attachment').css("opacity", 0);
			        // set a timer to re-apply the plugin
			        if (resizeTimer) clearTimeout(resizeTimer);
			        resizeTimer = setTimeout(collage, 200);
			        //collage();
            //$('.media').collageCaption();
		}
	}

	multiUploader.prototype._read = function(evt){
		if(evt.target.files){
			//console.log(evt.target.result);
			self._preview(evt.target.files);
			self.all.push(evt.target.files);
		} else 
			console.log("Failed file reading");
	}
	
	multiUploader.prototype._validate = function(format){
		var arr = this.config.support.split(",");
		return arr.indexOf(format);
	}
	
	multiUploader.prototype._dropFiles = function(e){
		e.stopPropagation(); e.preventDefault();
		self._preview(e.dataTransfer.files);
		self.all.push(e.dataTransfer.files);
	}
	
	multiUploader.prototype._uploader = function(file,f){
		if(typeof file[f] != undefined && self._validate(file[f].type) > 0){
			var data = new FormData();
			var ids = file[f].name._unique();
			data.append('file',file[f]);
			data.append('index',ids);
			data.append('csrf_token', $('input[name=csrf_token]').val());
			$(".dfiles[rel='"+ids+"']").find(".progress").show();
			$.ajax({
				type:"POST",
				url:this.config.uploadUrl,
				data:data,
				cache: false,
				contentType: false,
				processData: false,
				success:function(rponse){
					$("#"+ids).hide();
					var obj = $(".dfiles").get();
					$.each(obj,function(k,fle){
						//if($(fle).attr("rel") == rponse){
							$(fle).remove();//find('img').attr('src', rponse);
							$('#dragAndDropFiles').prepend(rponse);
							if (resizeTimer) clearTimeout(resizeTimer);
			        		resizeTimer = setTimeout(collage, 200);
							//$(fle).slideUp("normal", function(){ $(this).remove(); });
						//}
					});
					if (f+1 < file.length) {
						self._uploader(file,f+1);
					}
				}
			});
		} else
			console.log("Invalid file format - "+file[f].name);
	}
	
	multiUploader.prototype._startUpload = function(){
		if(this.all.length > 0){
			for(var k=0; k<this.all.length; k++){
				var file = this.all[k];
				this._uploader(file,0);
			}
		}
	}
	
	String.prototype._unique = function(){
		return this.replace(/[a-zA-Z]/g, function(c){
     	   return String.fromCharCode((c <= "Z" ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);
    	});
	}

	this._init();
}

function initMultiUploader(){
	new multiUploader(config);
}