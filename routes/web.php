<?php

use App\Livewire\HomeIndex;
use App\Livewire\MakanMana;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeIndex::class)->name('home');
Route::get('/find', MakanMana::class)->name('find');
