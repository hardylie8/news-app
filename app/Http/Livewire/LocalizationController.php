<?php

namespace App\Http\Livewire;

use App;
use Livewire\Component;

class LocalizationController extends Component
{
    /**
     * set language
     *
     * @param string $locale
     * @return mixed
     */
    public function boot($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
