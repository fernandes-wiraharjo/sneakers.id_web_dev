<div role="region" aria-labelledby="step-section-primary-header">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <div class="Yil88 TpQRn ny1C6">
        <div class="_1fragem15 _1fragemah _1fragemaf">
            <h1 class="n8k95w1 _1fragemaf n8k95w2">Information</h1>
        </div>
        <div class="I3DjT TeFT5">
            <div class="RTcqB">
                <header role="banner" class="nBWgL">
                    <div>
                        <div class="_1fragem15 _1fragem8q _1fragem97 _1fragem89 _1fragem9o _1fragemaf">
                            <div class="T50Pa Layout0 Z5iCK rhUtJ">
                                <style>
                                    .iframe-invoice {
                                        width: -webkit-fill-available;
                                        height: 800px;
                                    }
                                    .Layout0>.i602M> :nth-child(1) {
                                        flex: 0 0 100%;
                                    }

                                    .Layout0>.i602M {
                                        flex-wrap: wrap;
                                    }

                                    .Layout0>.i602M {
                                        max-width: 56rem;
                                    }

                                    @media all and (min-width: 1000px) {
                                        .Layout0>.i602M {
                                            max-width: 100%;
                                        }
                                    }

                                </style>
                                <div class="i602M AHe4G">
                                    <div>
                                        <div>
                                            <div class="_1fragem15 _1fragemaf">
                                                <div class="_1fragemaf _1fragem1b _1mrl40q3 _1fragem24 _1fragem2l _1fragem36 _1fragem3a _16s97g73 _16s97g75 _16s97g7b _16s97g7d" style="--_16s97g72: minmax(0, 20rem); --_16s97g74: minmax(0, 1fr); --_16s97g7a: minmax(0, 20rem); --_16s97g7c: minmax(0, 1fr);">
                                                    <p class="n8k95w1 _1fragemaf n8k95w2">
                                                        <a href="#" class="s2kwpi1 _1fragemaf _1fragemat _1fragemb2 s2kwpi3 _1fragemal">
                                                            <img src="{{ asset('stores-info/logos-black-transparent.png') }}" alt="sneakers.id" class="hmHjN" style="max-width: min(100%, 200px);">
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                @include('display-store.cart._partials.items', ['content', $content])
                <div class="dh43e">
                    <div class="_1fragem15 _1fragemaf">
                        {{-- Content --}}
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Cart</a></li>
                                <li class="breadcrumb-item {{ $currentStep != 1 ? '' : 'active' }}">
                                    @if ($currentStep != 1)
                                        <a href="#step1" wire:click="back(1)">Information</a>
                                    @else
                                        <strong>Information</strong>
                                    @endif
                                </li>
                                <li class="breadcrumb-item {{ $currentStep != 2 ? '' : 'active' }}">
                                    @if ($currentStep != 2)
                                        <a href="#step2" wire:click="back(2)">Shipping</a>
                                    @else
                                        <strong>Shipping</strong>
                                    @endif
                                </li>
                                <li class="breadcrumb-item {{ $currentStep != 3 ? '' : 'active' }}">
                                    @if ($currentStep != 3)
                                        <a href="#step3" wire:click="back(3)">Payment</a>
                                    @else
                                        <strong>Payment</strong>
                                    @endif
                                </li>
                            </ol>
                        </nav>

                        {{-- The Master doesn't talk, he acts. --}}
                        @if (!empty($successMessage))
                        <div class="alert alert-success">
                            {{ $successMessage }}
                        </div>
                        @endif

                        <div class="row pt-3">
                            {{-- Step 1 --}}
                            @include('display-store.cart._partials.information')

                            {{-- Step 2 --}}
                            @include('display-store.cart._partials.shipping')

                            {{-- Step 3 --}}
                            @include('display-store.cart._partials.payment')

                            {{-- Step 4 --}}
                            @include('display-store.cart._partials.invoice')

                            <footer role="contentinfo" class="QDqGb">
                                <div class="HgABA">
                                    <div class="_1fragem17 _1fragemaf _1fragem38">
                                        <div class="_5uqybw2 _1fragem17 _1fragem9r _1fragem2 _1fragem6 _1fragem1r _1fragem25 _1fragem38">
                                            <button type="button" data-toggle="modal" data-target="#exampleModal" class="QT4by eVFmT janiy mRJ8x" >
                                                <span class="AjwsM">
                                                    <span class="_19gi7yt0 _19gi7ytc _1fragem1i">
                                                        Refund policy
                                                    </span>
                                                </span>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#exampleModal1" class="QT4by eVFmT janiy mRJ8x">
                                                <span class="AjwsM">
                                                    <span class="_19gi7yt0 _19gi7ytc _1fragem1i">
                                                        Privacy policy
                                                    </span>
                                                </span>
                                            </button>
                                            <button type="button" data-toggle="modal" data-target="#exampleModal2" class="QT4by eVFmT janiy mRJ8x">
                                                <span class="AjwsM">
                                                    <span class="_19gi7yt0 _19gi7ytc _1fragem1i">
                                                        Terms of service
                                                    </span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('display-store.cart._partials.aside-items')
    </div>
    @include('display-store.cart._partials.policy-modal')



        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script>
        document.addEventListener('livewire:load', function () {
            // Your JS here.
            console.log("Livewire is working");
        })
    </script>
</div>

