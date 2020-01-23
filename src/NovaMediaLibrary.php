<?php

namespace ClassicO\NovaMediaLibrary;

use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaMediaLibrary extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        if (Auth::user()->can('Mediaverwaltung') === false) {
            return false;
        }

        Nova::script('nova-media-library', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-media-library', __DIR__.'/../dist/css/tool.css');

	    Nova::script('media-field', __DIR__.'/../dist/js/field.js');
	    Nova::style('media-field', __DIR__.'/../dist/css/field.css');


	    Nova::provideToScript( Core\Helper::frontConfig() );
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        if (Auth::user()->can('Mediaverwaltung')) {
            return view('nova-media-library::navigation');
        }
    }

}
