@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        	<div class="logo">
                <img src="http://pos.templatesvalley.com/assets/frontend/img/logo_mail.png" alt="" />
            </div>
            <?php /* ?>{{ config('app.name') }} <?php */ ?>
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @if (isset($subcopy))
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endif

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
                   
                    <div class="copyrights">
                        BitSolution &copy; {{ date('Y') }}
                    </div>
            <?php /* &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved. */ ?>
        @endcomponent
    @endslot
@endcomponent
