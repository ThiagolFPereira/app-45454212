<?php

// Route::view('/', 'vue.initial');
Route::get('/{vue_capture?}', function () {
    return view('vue.initial');
})->where('vue_capture', '[\/\w\.-]*');
