<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    @if (checkFeature('seo'))
        @if ($vcard->meta_description)
            <meta name="description" content="{{ $vcard->meta_description }}">
        @endif
        @if ($vcard->meta_keyword)
            <meta name="keywords" content="{{ $vcard->meta_keyword }}">
        @endif
    @else
        <meta name="description" content="{{ $vcard->description }}">
        <meta name="keywords" content="">
    @endif
    <meta property="og:image" content="{{ $vcard->cover_url }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (checkFeature('seo') && $vcard->site_title && $vcard->home_title)
        <title>{{ $vcard->home_title }} | {{ $vcard->site_title }}</title>
    @else
        <title>{{ $vcard->name }} | {{ getAppName() }}</title>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">

    {{-- css link --}}
    <link rel="stylesheet" href="{{ asset('assets/css/vcard6.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slider/css/slick-theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-vcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">

    @if (checkFeature('custom-fonts') && $vcard->font_family)
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{ $vcard->font_family }}">
    @endif
    @if ($vcard->font_family || $vcard->font_size || $vcard->custom_css)
        <style>
            @if (checkFeature('custom-fonts'))
                @if ($vcard->font_family)
                    body {
                        font-family: {{ $vcard->font_family }};
                    }
                @endif
                @if ($vcard->font_size)
                    div>h4 {
                        font-size: {{ $vcard->font_size }}px !important;
                    }
                @endif
            @endif
            @if (isset(checkFeature('advanced')->custom_css))
                {!! $vcard->custom_css !!}
            @endif
        </style>
    @endif

</head>

<body>

    <div class="container main-section ">
        @include('vcards.password')
        <div class="row d-flex justify-content-center content-blur">
            <div class="main-bg p-0 allSection collapse show">
                <div class="head-img position-relative">
                    <img src="{{ $vcard->cover_url }}" height="400px" class="img-fluid" />
                    <div class="d-flex justify-content-end position-absolute top-0 end-0 me-3">
                        @if ($vcard->language_enable == \App\Models\Vcard::LANGUAGE_ENABLE)
                            <div class="language pt-4 me-2">
                                <ul class="text-decoration-none">
                                    <li class="dropdown1 dropdown lang-list">
                                        <a class="dropdown-toggle lang-head text-decoration-none" data-toggle="dropdown"
                                            role="button" aria-haspopup="true" aria-expanded="false">
                                            <i
                                                class="fa-solid fa-language me-2"></i>{{ getLanguage($vcard->default_language) }}
                                        </a>
                                        <ul class="dropdown-menu start-0 lang-hover-list top-dropdown top-100">
                                            @foreach (getAllLanguageWithFullData() as $language)
                                                <li
                                                    class="{{ getLanguageIsoCode($vcard->default_language) == $language->iso_code ? 'active' : '' }}">
                                                    <a href="javascript:void(0)" id="languageName"
                                                        data-name="{{ $language->iso_code }}">
                                                        @if (array_key_exists($language->iso_code, \App\Models\User::FLAG))
                                                            @foreach (\App\Models\User::FLAG as $imageKey => $imageValue)
                                                                @if ($imageKey == $language->iso_code)
                                                                    <img src="{{ asset($imageValue) }}"
                                                                        class="me-1" />
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @if (count($language->media) != 0)
                                                                <img src="{{ $language->image_url }}" class="me-1" />
                                                            @else
                                                                <i class="fa fa-flag fa-xl me-3 text-danger"
                                                                    aria-hidden="true"></i>
                                                            @endif
                                                        @endif
                                                        {{ $language->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="position-relative">
                    <img src="{{ asset('assets/img/vcard6/Triangle.png') }}"
                        class="img-fluid position-absolute triangle-img" />
                    <img src="{{ asset('assets/img/vcard6/circle.png') }}"
                        class="img-fluid position-absolute circle-img" />
                    <img src="{{ asset('assets/img/vcard6/triangledown.png') }}"
                        class="img-fluid position-absolute triangle-down-img" />
                    <img src="{{ asset('assets/img/vcard6/Oval.png') }}"
                        class="img-fluid position-absolute oval-img" />

                    <div class="container">
                        <div class="main-profile position-relative">
                            <div class="profile-img">
                                <div class="row d-flex align-items-center mb-4 justify-content-center">
                                    <div class="col-md-4">
                                        <img src="{{ $vcard->profile_url }}"
                                            class="pro-img img-fluid position-relative" />
                                    </div>
                                    <div class="col-md-8 user-details-section">
                                        <div>
                                            <h4 class="heading-title">
                                                {{ ucwords($vcard->first_name . ' ' . $vcard->last_name) }}</h4>
                                            <p class="small-title text-light">{{ ucwords($vcard->occupation) }}</p>
                                            <p class="small-title text-light">{{ ucwords($vcard->job_title) }}</p>
                                            <p><span
                                                    class="small-company d-block text-light">{{ ucwords($vcard->company) }}</span>
                                            </p>
                                        </div>
                                        <div class="social-section">
                                            @if (checkFeature('social_links') && getSocialLink($vcard))
                                                <div class="social-icon d-flex flex-wrap">
                                                    @foreach (getSocialLink($vcard) as $value)
                                                        <div class="pro-icon">
                                                            {!! $value !!}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="pt-2 px-2 profile-description fs-6">{!! $vcard->description !!} </span>
                                    </div>
                                </div>
                                <div class="row">
                                    @if ($vcard->email)
                                        <div class="col-sm-6 mb-4">
                                            <div class="card border-0 bg-transparent">
                                                <div class="event-icon text-white">
                                                    <img src="{{ asset('assets/img/vcard6/email.png') }}"
                                                        class="img-fluid me-3" />
                                                    <a href="mailto:{{ $vcard->email }}"
                                                        class="email-text text-white text-decoration-none">{{ $vcard->email }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($vcard->alternative_email)
                                        <div class="col-sm-6 mb-4">
                                            <div class="card border-0 bg-transparent">
                                                <div class="event-icon text-white">
                                                    <img src="{{ asset('assets/img/vcard6/alter-image.png') }}"
                                                        class="img-fluid me-3" />
                                                    <a href="mailto:{{ $vcard->alternative_email }}"
                                                        class="email-text text-white text-decoration-none">{{ $vcard->alternative_email }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($vcard->phone)
                                        <div class="col-sm-6 mb-4">
                                            <div class="card border-0 bg-transparent">
                                                <div class="event-icon text-white">
                                                    <img src="{{ asset('assets/img/vcard6/call.png') }}"
                                                        class="img-fluid me-3" />
                                                    <a href="tel:+{{ $vcard->region_code }}{{ $vcard->phone }}"
                                                        class="email-text text-white text-decoration-none">+{{ $vcard->region_code }}
                                                        {{ $vcard->phone }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($vcard->alternative_phone)
                                        <div class="col-sm-6 mb-4">
                                            <div class="card border-0 bg-transparent">
                                                <div class="event-icon text-white">
                                                    <img src="{{ asset('assets/img/vcard6/call.png') }}"
                                                        class="img-fluid me-3" />
                                                    <a href="tel:+{{ $vcard->alternative_region_code }}{{ $vcard->alternative_phone }}"
                                                        class="email-text text-white text-decoration-none">+{{ $vcard->alternative_region_code }}
                                                        {{ $vcard->alternative_phone }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($vcard->dob)
                                        <div class="col-sm-6 mb-4">
                                            <div class="card border-0 bg-transparent">
                                                <div class="event-icon text-white">
                                                    <img src="{{ asset('assets/img/vcard6/cake.png') }}"
                                                        class="img-fluid me-3" />
                                                    <span>{{ $vcard->dob  }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($vcard->location)
                                        <div class="col-sm-6 mb-4">
                                            <div class="card border-0 bg-transparent">
                                                <div class="event-icon text-white">
                                                    <img src="{{ asset('assets/img/vcard6/location.png') }}"
                                                        class="img-fluid me-3" />
                                                    <span>{{ ucwords($vcard->location) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Qr code --}}
                @if (isset($vcard['show_qr_code']) && $vcard['show_qr_code'] == 1)
                    <div class="main-qrcode position-relative pt-8">
                        <img src="{{ asset('assets/img/vcard6/orengcircle.png') }}"
                            class="img-fluid position-absolute orengcircle-img" />
                        <img src="{{ asset('assets/img/vcard6/uptriangle.png') }}"
                            class="img-fluid position-absolute uptriangle-img" />
                        <img src="{{ asset('assets/img/vcard6/halfcircle.png') }}"
                            class="img-fluid position-absolute halfcircle-img" />
                        <img src="{{ asset('assets/img/vcard6/orengtriangle.png') }}"
                            class="img-fluid position-absolute orengtriangle-img" />
                        <img src="{{ asset('assets/img/vcard6/halfblue.png') }}"
                            class="img-fluid position-absolute circle2-img" />

                        <div class="container mt-3 mb-5">
                            <div class="main-Qr-section mb-5">
                                <div>
                                    <h4 class="mb-4 text-center heading-title">{{ __('messages.vcard.qr_code') }}</h4>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-6">
                                        <div class="text-center mb-4" id="qr-code-six">
                                            @if (isset($customQrCode['applySetting']) && $customQrCode['applySetting'] == 1)
                                                {!! QrCode::color(
                                                    $qrcodeColor['qrcodeColor']->red(),
                                                    $qrcodeColor['qrcodeColor']->green(),
                                                    $qrcodeColor['qrcodeColor']->blue(),
                                                )->backgroundColor(
                                                        $qrcodeColor['background_color']->red(),
                                                        $qrcodeColor['background_color']->green(),
                                                        $qrcodeColor['background_color']->blue(),
                                                    )->style($customQrCode['style'])->eye($customQrCode['eye_style'])->size(130)->format('svg')->generate(Request::url()) !!}
                                            @else
                                                {!! QrCode::size(130)->format('svg')->generate(Request::url()) !!}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="text-center">
                                            <img src="{{ $vcard->profile_url }}" class="qr-logo rounded-circle" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- our-section --}}
                @if (checkFeature('services') && $vcard->services->count())
                    <div class="main-service-our position-relative ">
                        <img src="{{ asset('assets/img/vcard6/smalltriangle.png') }}"
                            class="img-fluid position-absolute smalltriangle-img" />
                        <img src="{{ asset('assets/img/vcard6/pinkoval.png') }}"
                            class="img-fluid position-absolute pinkoval-img" />
                        <img src="{{ asset('assets/img/vcard6/redoval.png') }}"
                            class="img-fluid position-absolute redoval-img" />
                        <img src="{{ asset('assets/img/vcard6/blueoval.png') }}"
                            class="img-fluid position-absolute blueoval-img" />

                        <div class="container py-5 mb-10 mt-0">
                            <div class="main-our-section position-relative">
                                <h4 class="text-center mb-10 heading-title">{{ __('messages.vcard.our_service') }}
                                </h4>
                                <div class="row g-6 justify-content-center">
                                    @foreach ($vcard->services as $service)
                                        <div class="col-sm-6">
                                            <div class="card service-card h-100">
                                                <a href="{{ $service->service_url ?? 'javascript:void(0)' }}"
                                                    class="text-decoration-none {{ $service->service_url ? 'pe-auto' : 'pe-none' }}"
                                                    target="{{ $service->service_url ? '_blank' : '' }}">
                                                    <img src="{{ $service->service_icon }}"
                                                        class="card-img-top service-new-image"
                                                        alt="{{ $service->name }}">
                                                </a>
                                                <div class="card-body px-0 py-3 text-white">
                                                    <h5 class="card-title">{{ ucwords($service->name) }}</h5>
                                                    <p
                                                        class="card-text text-gray-200 {{ \Illuminate\Support\Str::length($service->description) > 80 ? 'more' : '' }}">
                                                        {!! $service->description !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- gallery --}}
                @if (checkFeature('gallery') && $vcard->gallery->count())
                    <div class="main-gallery position-relative ">
                        <img src="{{ asset('assets/img/vcard6/testioval.png') }}"
                            class="img-fluid position-absolute testioval-img" />
                        <img src="{{ asset('assets/img/vcard6/testiright.png') }}"
                            class="img-fluid position-absolute testiright-img" />
                        <img src="{{ asset('assets/img/vcard6/bluetesti.png') }}"
                            class="img-fluid position-absolute bluetesti-img" />
                        <img src="{{ asset('assets/img/vcard6/circle.png') }}"
                            class="img-fluid position-absolute circletesti-img" />
                        <img src="{{ asset('assets/img/vcard6/circle.png') }}"
                            class="img-fluid position-absolute circle2-img" />

                        <div class="container mt-3 mb-5 mb-10 mt-0">
                            <h3 class="text-center mb-4 text-light">{{ __('messages.plan.gallery') }}</h3>
                            <div class="gallery-section position-relative">
                                <div class="row g-3 gallery-slider">
                                    @foreach ($vcard->gallery as $file)
                                        @php
                                            $infoPath = pathinfo(public_path($file->gallery_image));
                                            $extension = $infoPath['extension'];
                                        @endphp
                                        <div class="col-6">
                                            <div class="card w-100 h-100 bg-transparent border-0 text-light">
                                                <div class="gallery-profile">
                                                    @if ($file->type == App\Models\Gallery::TYPE_IMAGE)
                                                        <a href="{{ $file->gallery_image }}"
                                                            data-lightbox="gallery-images"><img
                                                                src="{{ $file->gallery_image }}" alt="profile"
                                                                class="w-100" /></a>
                                                    @elseif($file->type == App\Models\Gallery::TYPE_FILE)
                                                        <a id="file_url" href="{{ $file->gallery_image }}"
                                                            class="gallery-link gallery-file-link" target="_blank">
                                                            <div class="gallery-item"
                                                                @if ($extension == 'pdf') style="background-image: url({{ asset('assets/images/pdf-icon.png') }})"> @endif
                                                                @if ($extension == 'xls') style="background-image: url({{ asset('assets/images/xls.png') }})"> @endif
                                                                @if ($extension == 'csv') style="background-image: url({{ asset('assets/images/csv-file.png') }})"> @endif
                                                                @if ($extension == 'xlsx') style="background-image: url({{ asset('assets/images/xlsx.png') }})"> @endif
                                                                </div>
                                                        </a>
                                            @elseif($file->type == App\Models\Gallery::TYPE_VIDEO)
                                             <div class="d-flex align-items-center video-container">
                                                <video width="100%" controls>
                                                    <source src="{{ $file->gallery_image }}">
                                                </video></div>
                                            @elseif($file->type == App\Models\Gallery::TYPE_AUDIO)
                                                <div class="audio-container">
                                                    <img src="{{ asset('assets/img/music.jpeg') }}" alt="Album Cover" class="audio-image" height="173">
                                                    <audio controls src="{{ $file->gallery_image }}" class="mt-3">
                                                        Your browser does not support the <code>audio</code> element.
                                                    </audio>
                                                </div>
                                            @else
                                            <iframe src="https://www.youtube.com/embed/{{ YoutubeID($file->link) }}"
                                                class="w-100 h-100">
                                            </iframe>
                                            @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- product --}}
                @if (checkFeature('products') && $vcard->products->count())
                    <div class="main-product position-relative ">
                        <img src="{{ asset('assets/img/vcard6/testioval.png') }}"
                            class="img-fluid position-absolute testioval-img" />
                        <img src="{{ asset('assets/img/vcard6/testiright.png') }}"
                            class="img-fluid position-absolute testiright-img" />
                        <img src="{{ asset('assets/img/vcard6/bluetesti.png') }}"
                            class="img-fluid position-absolute bluetesti-img" />
                        <img src="{{ asset('assets/img/vcard6/circle.png') }}"
                            class="img-fluid position-absolute circletesti-img" />
                        <img src="{{ asset('assets/img/vcard6/circle.png') }}"
                            class="img-fluid position-absolute circle2-img" />

                        <div class="container mt-3 mb-5 mb-10 mt-0">
                            <h4 class="text-center mb-4 text-light product-title">{{ __('messages.vcard.products') }}
                            </h4>
                            <div class="text-end me-5 my-3">
                            <a class="fs-4 mb-0 text-light" href="{{ route('showProducts',['id'=>$vcard->id,'alias'=>$vcard->url_alias]) }}">{{__('messages.analytics.view_more')}}</a>
                        </div>
                            <div class="product-section position-relative">
                                <div class="row g-3 product-card">
                                    @foreach ($vcardProducts as $product)
                                        <div class="col-6">
                                            <a @if ($product->product_url) href="{{ $product->product_url }}" @endif
                                                target="_blank" class="text-decoration-none fs-6">
                                                <div class="card  w-100 h-100 bg-transparent border-0 text-light">
                                                    <div class="product-profile">
                                                        <img src="{{ $product->product_icon }}" alt="profile"
                                                            class="w-100" height="208px" />
                                                    </div>
                                                    <div class="product-details mt-3">
                                                        <h4>{{ $product->name }}</h4>
                                                        <p class="mb-2 overflow-scroll">
                                                            {{ $product->description }}
                                                        </p>
                                                        @if ($product->currency_id && $product->price)
                                                            <span
                                                                class="text-light">{{ $product->currency->currency_icon }}{{ number_format($product->price, 2) }}</span>
                                                        @elseif($product->price)
                                                            <span class="text-light">{{ getUserCurrencyIcon($vcard->user->id) .' '. $product->price }}</span>
                                                        @else
                                                            <span class="text-black">N/A</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- testimonial --}}
                @if (checkFeature('testimonials') && $vcard->testimonials->count())
                    <div class="main-testimonial position-relative mb-18">
                        <img src="{{ asset('assets/img/vcard6/testioval.png') }}"
                            class="img-fluid position-absolute testioval-img" />
                        <img src="{{ asset('assets/img/vcard6/testiright.png') }}"
                            class="img-fluid position-absolute testiright-img" />
                        <img src="{{ asset('assets/img/vcard6/bluetesti.png') }}"
                            class="img-fluid position-absolute bluetesti-img" />
                        <img src="{{ asset('assets/img/vcard6/circle.png') }}"
                            class="img-fluid position-absolute circletesti-img" />
                        <img src="{{ asset('assets/img/vcard6/circle.png') }}"
                            class="img-fluid position-absolute circle2-img" />

                        <div class="container mt-3 mb-10 mt-0">
                            <h4 class="text-center mb-4 heading-title">{{ __('messages.plan.testimonials') }}</h4>
                            <div class="testimonial-section position-relative">
                                <div class="row g-3 testimonial-card">
                                    @foreach ($vcard->testimonials as $testimonial)
                                        <div class="col-6">
                                            <div class="card  w-100 h-100 bg-transparent border-0 text-light">
                                                <div class="testimonial-card-img">
                                                    <img src="{{ $testimonial->image_url }}"
                                                        class="testimonial-image d-block mx-auto rounded-circle" />
                                                </div>
                                                <div>
                                                    <p
                                                        class="mb-0 text-center pt-3 testi-details {{ \Illuminate\Support\Str::length($testimonial->description) > 80 ? 'more' : '' }}">
                                                        “{!! $testimonial->description !!}”
                                                    </p>
                                                </div>
                                                <div
                                                    class="testimonial-user d-flex justify-content-center flex-column align-center mt-3">
                                                    <h5 class="user-name text-center position-relative mt-2 mb-0">
                                                        {{ ucwords($testimonial->name) }}</h5>
                                                    <span class="user-designation text-center"></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- blog --}}
                @if (checkFeature('blog') && $vcard->blogs->count())
                    <div class="vcard-six-blog py-3 position-relative">
                        <img src="{{ asset('assets/img/vcard6/bluetesti.png') }}"
                            class="img-fluid position-absolute bluetesti-img" />
                        <img src="{{ asset('assets/img/vcard6/circle.png') }}"
                            class="img-fluid position-absolute circletesti-img" />
                        <h4 class="text-center mb-4 text-light heading-title">{{ __('messages.feature.blog') }}</h4>
                        <div class="container mb-10 mt-0">
                            <div class="row g-4 blog-slider overflow-hidden">
                                @foreach ($vcard->blogs as $blog)
                                    <div class="col-6 mb-2">
                                        <div class="card blog-card p-4 border-0 w-100 h-100">
                                            <div class="blog-image">
                                                <a
                                                    href="{{ route('vcard.show-blog', [$vcard->url_alias, $blog->id]) }}">
                                                    <img src="{{ $blog->blog_icon }}" alt="profile"
                                                        class="w-100" />
                                                </a>
                                            </div>
                                            <div class="blog-details mt-3">
                                                <a href="{{ route('vcard.show-blog', [$vcard->url_alias, $blog->id]) }}"
                                                    class="text-decoration-none">
                                                    <h4
                                                        class="text-sm-start text-center title-color p-3 mb-0 text-white">
                                                        {{ $blog->title }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- business hour --}}
                @if ($vcard->businessHours->count())
                    @php
                        $todayWeekName = strtolower(\Carbon\Carbon::now()->rawFormat('D'));
                    @endphp
                    <div class="main-businesshour position-relative pt-4">
                        <img src="{{ asset('assets/img/vcard6/yellowcircle.png') }}"
                            class="img-fluid position-absolute yellowoval-img" />
                        <img src="{{ asset('assets/img/vcard6/bigbox.png') }}"
                            class="img-fluid position-absolute orangecircle-img" />
                        <img src="{{ asset('assets/img/vcard6/leftblue.png') }}"
                            class="img-fluid position-absolute leftblue-img" />

                        <div class="container mt-3 mb-10 mt-0">
                            <div class="main-business position-relative">
                                <h4 class="text-center mb-4 heading-title">{{ __('messages.vcard.buisness_hours') }}
                                </h4>
                                <div class="row g-3">
                                    @foreach ($businessDaysTime as $key => $dayTime)
                                        <div class="col-12">
                                            <div
                                                class="card business-card flex-row
                                        {{ \App\Models\BusinessHour::DAY_OF_WEEK[$key] == $todayWeekName ? 'business-card-today' : '' }}">
                                                <div class="calendar-icon p-4">
                                                    <i class="fa-solid fa-calendar-days fs-1 text-white"></i>
                                                </div>
                                                <div class="ms-sm-2 ms-3">
                                                    <div class="text-muted ms-sm-5 business-hour-day-text">
                                                        {{ __('messages.business.' . \App\Models\BusinessHour::DAY_OF_WEEK[$key]) }}
                                                    </div>
                                                    <div class="ms-sm-5 fw-bold mt-3 fs-4 business-hour-time-text">
                                                        {{ $dayTime ?? __('messages.common.closed') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                {{-- appointment --}}
                @if (checkFeature('appointments') && $vcard->appointmentHours->count())
                    <div class="container pt-5 mb-10 mt-0">
                        <div class="appointment">
                            <h3 class="appointment-heading mb-4 position-relative text-center text-white">
                                {{ __('messages.make_appointments') }}</h3>
                            <div class="row d-flex align-items-center justify-content-center mb-3">
                                <div class="col-md-2">
                                    <label for="date"
                                        class="appoint-date mb-2">{{ __('messages.date') }}</label>
                                </div>
                                <div class="col-md-10">
                                    {{ Form::text('date', null, ['class' => 'date appoint-input', 'placeholder' => __('messages.form.pick_date'), 'id' => 'pickUpDate']) }}
                                </div>
                            </div>
                            <div class="row d-flex align-items-center justify-content-center mb-md-3">
                                <div class="col-md-2">
                                    <label for="text"
                                        class="appoint-date mb-2">{{ __('messages.hour') }}</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="slotData" class="row">
                                    </div>
                                </div>
                            </div>
                            <button type="button"
                                class="appointmentAdd appoint-btn rounded mt-4 d-block mx-auto btn btn-lg">{{ __('messages.make_appointments') }}
                            </button>
                        </div>
                    </div>
                    @include('vcardTemplates.appointment')
                @endif
                {{-- contact us --}}
                @php
                    $currentSubs = $vcard
                        ->subscriptions()
                        ->where('status', \App\Models\Subscription::ACTIVE)
                        ->latest()
                        ->first();
                @endphp
                <div class="main-contactus position-relative pt-sm-5 ">
                    @if ($currentSubs && $currentSubs->plan->planFeature->enquiry_form && $vcard->enable_enquiry_form)
                        <img src="{{ asset('assets/img/vcard6/lightyellow.png') }}"
                            class="img-fluid position-absolute lightyellow-img" />
                        <img src="{{ asset('assets/img/vcard6/smallpink.png') }}"
                            class="img-fluid position-absolute smallpink-img" />
                        <img src="{{ asset('assets/img/vcard6/lighttraingle.png') }}"
                            class="img-fluid position-absolute light-img" />
                        <img src="{{ asset('assets/img/vcard6/smallblue.png') }}"
                            class="img-fluid position-absolute smallblue-img" />
                        <img src="{{ asset('assets/img/vcard6/halfbox.png') }}"
                            class="img-fluid position-absolute halfbox-img" />

                        <div class="container mb-10 mt-0">
                            <div class="contactus-section position-relative">
                                <h4 class="text-center mb-4 heading-title">{{ __('messages.contact_us.inquries') }}
                                </h4>
                                <div class="main-contact">
                                    <form id="enquiryForm">
                                        @csrf
                                        <div class="row">
                                            <div id="enquiryError" class="alert alert-danger d-none"></div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label for="basic-url"
                                                        class="form-label mb-0">{{ __('messages.user.your_name') }}</label>
                                                    <div class="col-12 mb-3 input-group">
                                                        <span
                                                            class="input-group-text contact-icon bg-transparent border-end-0"
                                                            id="basic-addon1"><i
                                                                class="far fa-user font-clr"></i></span>
                                                        <input type="text" name="name"
                                                            class="form-control contact-input bg-transparent border-start-0"
                                                            id="name"
                                                            placeholder="{{ __('messages.form.your_name') }}">
                                                    </div>

                                                    <label for="basic-url"
                                                        class="form-label mb-0">{{ __('messages.user.email') }}</label>
                                                    <div class="col-12 mb-3 input-group">
                                                        <span
                                                            class="input-group-text bg-transparent contact-icon border-end-0"
                                                            id="basic-addon1"><i
                                                                class="far fa-envelope font-clr"></i></span>
                                                        <input type="text" name="email"
                                                            class="form-control contact-input border-start-0 bg-transparent"
                                                            id="email"
                                                            placeholder="{{ __('messages.form.your_email') }}">
                                                    </div>

                                                    <label for="inputAddress"
                                                        class="form-label mb-0">{{ __('messages.user.phone') }}</label>
                                                    <div class="col-12 mb-3 input-group">
                                                        <span
                                                            class="input-group-text bg-transparent contact-icon border-end-0"
                                                            id="basic-addon1"><i
                                                                class="fas fa-phone font-clr"></i></span>
                                                        <input type="tel" name="phone"
                                                            class="form-control contact-input border-start-0 bg-transparent"
                                                            id="phone"
                                                            placeholder="{{ __('messages.form.phone') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label mb-0">{{ __('messages.user.your_message') }}</label>
                                                        <textarea name="message" class="form-control contact-input bg-transparent" id="message" rows="7"
                                                            placeholder="{{ __('messages.form.type_message') }}"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center mt-3">
                                                <button type="submit"
                                                    class="btn contact-btn px-4">{{ __('messages.contact_us.send_message') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if (!empty($userSetting['enable_affiliation']))
                    <div class="container mb-10">
                        <h4 class="vcard-six-heading text-center mb-5">
                            {{ __('messages.create_vcard') }}</h4>
                        <div class="bg-white p-4 text-center rounded mb-20">
                            <a href="{{ route('register', ['referral-code' => $vcard->user->affiliate_code]) }}"
                                target="_blank"
                                class="d-flex justify-content-center align-items-center text-decoration-none link-text font-primary">{{ route('register', ['referral-code' => $vcard->user->affiliate_code]) }}<i
                                    class="fa-solid fa-arrow-up-right-from-square ms-3"></i></a>
                        </div>
                    </div>
                @endif
                @if ($vcard->location_url && isset($url[5]))
                    <div class="m-2 mb-10 mt-0">
                        <iframe width="100%" height="300px"
                            src='https://maps.google.de/maps?q={{ $url[5] }}/&output=embed' frameborder="0"
                            scrolling="no" marginheight="0" marginwidth="0" style="border-radius: 10px;"></iframe>
                    </div>
                @endif
                <div class="d-flex justify-content-evenly">
                    @if (checkFeature('advanced'))
                        @if (checkFeature('advanced')->hide_branding && $vcard->branding == 0)
                            @if ($vcard->made_by)
                                <a @if (!is_null($vcard->made_by_url)) href="{{ $vcard->made_by_url }}" @endif
                                    class="text-center text-decoration-none text-white" target="_blank">
                                    <small>{{ __('messages.made_by') }} {{ $vcard->made_by }}</small>
                                </a>
                            @else
                                <div class="text-center text-white">
                                    <small>{{ __('messages.made_by') }} {{ $setting['app_name'] }}</small>
                                </div>
                            @endif
                        @endif
                    @else
                        @if ($vcard->made_by)
                            <a @if (!is_null($vcard->made_by_url)) href="{{ $vcard->made_by_url }}" @endif
                                class="text-center text-decoration-none text-white" target="_blank">
                                <small>{{ __('messages.made_by') }} {{ $vcard->made_by }}</small>
                            </a>
                        @else
                            <div class="text-center text-white">
                                <small>{{ __('messages.made_by') }} {{ $setting['app_name'] }}</small>
                            </div>
                        @endif
                    @endif
                    @if (!empty($vcard->privacy_policy) || !empty($vcard->term_condition))
                        <div>
                            <a class="text-decoration-none text-white cursor-pointer terms-policies-btn"
                                href="{{ route('vcard.show-privacy-policy', [$vcard->url_alias, $vcard->id]) }}"><small>{!! __('messages.vcard.term_policy') !!}</small></a>
                        </div>
                    @endif
                </div>

                <div class="w-100 d-flex justify-content-center  position-fixed"
                    style="top:50%; left:0; z-index: 9999;">
                    <div class="vcard-bars-btn position-relative">
                        @if (empty($userSetting['hide_stickybar']))
                            <a href="javascript:void(0)"
                                class="vcard6-sticky-btn border-0  bars-btn d-flex bg-primary justify-content-center  me-5 align-items-center rounded-0 px-5 mb-3 text-decoration-none py-1 rounded-pill justify-content-center">
                                <img src="{{ asset('assets/img/vcard6/sticky.png') }}" />
                            </a>
                        @endif
                        <div class="sub-btn d-none">
                            <div class="sub-btn-div">
                                @if (isset($userSetting['whatsapp_share']) && $userSetting['whatsapp_share'] == 1)
                                    <div class="icon-search-container mb-3" data-ic-class="search-trigger">
                                        <div class="wp-btn">
                                            <i class="fab text-light  fa-whatsapp fa-2x" id="wpIcon"></i>
                                        </div>
                                        <input type="number" class="search-input" id="wpNumber"
                                            data-ic-class="search-input"
                                            placeholder="{{ __('messages.setting.wp_number') }}" />
                                        <div class="share-wp-btn-div">
                                            <a href="javascript:void(0)"
                                                class=" vcard6-sticky-btn vcard6-btn-group d-flex justify-content-center align-items-center rounded-0 text-decoration-none py-1 rounded-pill justify-content share-wp-btn">
                                                <i class="fa-solid fa-paper-plane"></i> </a>
                                        </div>
                                    </div>
                                @endif
                                @if (empty($userSetting['hide_stickybar']))
                                    <div
                                        class="{{ isset($userSetting['whatsapp_share']) && $userSetting['whatsapp_share'] == 1 ? 'vcard6-btn-group' : 'stickyIcon' }}">
                                        <button type="button"
                                            class="vcard6-sticky-btn vcard6-share vcard-btn-group mb-3 vcard6-sticky-btn vcard6-btn-group rounded-0 px-2 "><i
                                                class="fas fa-share-alt fs-1"></i></button>
                                        <a type="button"
                                            class="vcard6-sticky-btn vcard6-sticky-btn  mb-3 d-flex justify-content-center align-items-center vcard6-btn-group px-2 mb-3 py-2"
                                            id="qr-code-btn" download="qr_code.png"><i
                                                class="fa-solid fa-qrcode fs-1"></i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="w-100 d-flex justify-content-center sticky-vcard-div">
                            @if (!empty($userSetting['enable_contact']))
                                <a href="{{ route('add-contact', $vcard->id) }}"
                                    class="add-contact-btn d-flex justify-content-center ms-0 align-items-center rounded px-5 text-decoration-none py-1  justify-content-center "><i
                                        class="fas fa-download fa-address-book fs-4"></i>
                                    &nbsp;{{ __('messages.setting.add_contact') }}</a>
                            @endif
                        </div>
                        @include('vcardTemplates.template.templates')

                        {{-- share modal code --}}
                        <div id="vcard6-shareModel" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('messages.vcard.share_my_vcard') }}</h5>
                                        <button type="button" aria-label="Close"
                                            class="btn btn-sm btn-icon btn-active-color-danger"
                                            data-bs-dismiss="modal">
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                                        fill="#000000">
                                                        <rect fill="#000000" x="0" y="7"
                                                            width="16" height="2" rx="1" />
                                                        <rect fill="#000000" opacity="0.5"
                                                            transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                                            x="0" y="7" width="16"
                                                            height="2" rx="1" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                    @php
                                        $shareUrl = route('vcard.show', ['alias' => $vcard->url_alias]);
                                    @endphp
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12 justify-content-between social-link-modal">
                                                <a href="http://www.facebook.com/sharer.php?u={{ $shareUrl }}"
                                                    target="_blank" class="mx-2 share6" title="Facebook">
                                                    <i class="fab fa-facebook fa-2x" style="color: #1B95E0"></i>
                                                </a>
                                                <a href="http://twitter.com/share?url={{ $shareUrl }}&text={{ $vcard->name }}&hashtags=sharebuttons"
                                                    target="_blank" class="mx-2 share6" title="Twitter">
                                                    <i class="fab fa-twitter fa-2x" style="color: #1DA1F3"></i>
                                                </a>
                                                <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}"
                                                    target="_blank" class="mx-2 share6" title="Linkedin">
                                                    <i class="fab fa-linkedin fa-2x" style="color: #1B95E0"></i>
                                                </a>
                                                <a href="mailto:?Subject=&Body={{ $shareUrl }}" target="_blank"
                                                    class="mx-2" title="Email">
                                                    <i class="fas fa-envelope fa-2x share6"
                                                        style="color: #191a19  "></i>
                                                </a>
                                                <a href="http://pinterest.com/pin/create/link/?url={{ $shareUrl }}"
                                                    target="_blank" class="mx-2">
                                                    <i class="fab fa-pinterest fa-2x share6" style="color: #bd081c"
                                                        title="Pinterest"></i>
                                                </a>
                                                <a href="http://reddit.com/submit?url={{ $shareUrl }}&title={{ $vcard->name }}"
                                                    target="_blank" class="mx-2 share6" title="Reddit">
                                                    <i class="fab fa-reddit fa-2x" style="color: #ff4500"></i>
                                                </a>
                                                <a href="https://wa.me/?text={{ $shareUrl }}" target="_blank"
                                                    class="mx-2 share6" title="Whatsapp">
                                                    <i class="fab fa-whatsapp fa-2x" style="color: limegreen"></i>
                                                </a>
                                                <span id="vcardUrlCopy{{ $vcard->id }}" class="d-none"
                                                    target="_blank">
                                                    {{ route('vcard.show', ['alias' => $vcard->url_alias]) }} </span>
                                                <button class="mx-2 copy-vcard-clipboard" title="Copy Link"
                                                    data-id="{{ $vcard->id }}">
                                                    <i class="fa-regular fa-copy fa-2x" style="color: #0099fb"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-center">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                    <script src="https://js.stripe.com/v3/"></script>
                    <script type="text/javascript" src="{{ asset('assets/js/front-third-party.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
                    <script src="{{ asset('assets/js/slider/js/slick.min.js') }}" type="text/javascript"></script>
                    <script>
                        @if (checkFeature('seo') && $vcard->google_analytics)
                            {!! $vcard->google_analytics !!}
                        @endif
                        @if (isset(checkFeature('advanced')->custom_js) && $vcard->custom_js)
                            {!! $vcard->custom_js !!}
                        @endif
                    </script>
                    @php
                        $setting = \App\Models\UserSetting::where('user_id', $vcard->tenant->user->id)
                            ->where('key', 'stripe_key')
                            ->first();
                    @endphp
                    <script>
                        let stripe = ''
                        @if (!empty($setting) && !empty($setting->value))
                            stripe = Stripe('{{ $setting->value }}');
                        @endif
                        $('.testimonial-card').slick({
                            dots: true,
                            infinite: true,
                            speed: 300,
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            prevArrow: '<button class="slide-arrow prev-arrow"></button>',
                            nextArrow: '<button class="slide-arrow next-arrow"></button>',
                            arrows: true,
                            autoplay: true,
                            responsive: [{
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    dots: true,
                                },
                            }, ],
                        })
                    </script>
                    <script>
                        $('.gallery-slider').slick({
                            dots: true,
                            infinite: true,
                            arrows: true,
                            speed: 300,
                            slidesToShow: 2,
                            autoplay: true,
                            slidesToScroll: 1,
                            prevArrow: '<button class="slide-arrow prev-arrow"></button>',
                            nextArrow: '<button class="slide-arrow next-arrow"></button>',
                            responsive: [{
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    dots: true
                                }
                            }]
                        });
                    </script>
                    <script>
                        $('.product-card').slick({
                            dots: true,
                            infinite: true,
                            arrows: true,
                            speed: 300,
                            slidesToShow: 2,
                            autoplay: true,
                            slidesToScroll: 1,
                            prevArrow: '<button class="slide-arrow prev-arrow"></button>',
                            nextArrow: '<button class="slide-arrow next-arrow"></button>',
                            responsive: [{
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    dots: true,
                                },
                            }]
                        });

                        $('.blog-slider').slick({
                            dots: true,
                            infinite: true,
                            arrows: true,
                            speed: 300,
                            slidesToShow: 1,
                            autoplay: true,
                            slidesToScroll: 1,
                            prevArrow: '<button class="slide-arrow-blog prev-arrow"></button>',
                            nextArrow: '<button class="slide-arrow-blog next-arrow"></button>',
                        })
                    </script>
                    <script>
                        let isEdit = false
                        let password = "{{ isset(checkFeature('advanced')->password) && !empty($vcard->password) }}"
                        let passwordUrl = "{{ route('vcard.password', $vcard->id) }}";
                        let enquiryUrl = "{{ route('enquiry.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
                        let appointmentUrl = "{{ route('appointment.store', ['vcard' => $vcard->id, 'alias' => $vcard->url_alias]) }}";
                        let slotUrl = "{{ route('appointment-session-time', $vcard->url_alias) }}";
                        let appUrl = "{{ config('app.url') }}";
                        let vcardId = {{ $vcard->id }};
                        let vcardAlias = "{{ $vcard->url_alias }}";
                        let paypalUrl = "{{ route('paypal.init') }}"
                        let languageChange = "{{ url('language') }}";
                        let lang = "{{ checkLanguageSession($vcard->url_alias) }}";
                    </script>
                    <script>
                        const qrCodeSix = document.getElementById("qr-code-six");
                        const svg = qrCodeSix.querySelector("svg");
                        const blob = new Blob([svg.outerHTML], {
                            type: 'image/svg+xml'
                        });
                        const url = URL.createObjectURL(blob);
                        const image = document.createElement('img');
                        image.src = url;
                        image.addEventListener('load', () => {
                            const canvas = document.createElement('canvas');
                            canvas.width = canvas.height = {{ $vcard->qr_code_download_size }};
                            const context = canvas.getContext('2d');
                            context.drawImage(image, 0, 0, canvas.width, canvas.height);
                            const link = document.getElementById('qr-code-btn');
                            link.href = canvas.toDataURL();
                            URL.revokeObjectURL(url);
                        });
                    </script>
                    @routes
                    <script src="{{ asset('messages.js') }}"></script>
                    <script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
                    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
                    <script src="{{ mix('assets/js/vcards/vcard-view.js') }}"></script>
                    <script src="{{ mix('assets/js/lightbox.js') }}"></script>

</body>

</html>