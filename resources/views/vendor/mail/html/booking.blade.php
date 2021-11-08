@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        	<div class="logo">
                <img src="https://dev.letsdrool.ch/assets/images/logo.png" alt="" />
            </div>
            <?php /* ?>{{ config('app.name') }} <?php */ ?>
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <div class="footer">
                <div class="sm-icons">
                    <a href="anfrage@brainlabs.ch"><img src="https://dev.letsdrool.ch/assets/images/icon-mail.png" alt="" /></a>
                    <a href="https://facebook.com/letsdrool"><img src="https://dev.letsdrool.ch/assets/images/icon-facebook.png" alt="" /></a>
                    <a href="https://twitter.com/letsdrool"><img src="https://dev.letsdrool.ch/assets/images/icon-twitter.png" alt="" /></a>
                    <a href="https://www.instagram.com/letsdrool/"><img src="https://dev.letsdrool.ch/assets/images/icon-instagram.png" alt="" /></a>
                </div>
                <div class="copyrights">
                    BraibLabs &copy; {{ date('Y') }}
                </div>
            </div>
            <?php /* &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved. */ ?>
        @endcomponent
    @endslot
@endcomponent
