<?php 

echo render('docs::index')
        ->with('ui', document('ui'))
        ->with('docs', document('docs'));
