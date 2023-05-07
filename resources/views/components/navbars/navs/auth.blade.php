@props(['titlePage' , 'pageType'])

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">{{__("common.pages")}}</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ __("common." . $titlePage) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{ __("common." . $titlePage)  }} 
                
                @isset($pageType)
                / {{ __("common." . $pageType) ." ". __("common." . $titlePage) }} 
                @endisset
             </h6>
        </nav>
        
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <label class="form-label">{{__('common.typeHere')}} </label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('profile.edit') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__("common.SignOut")}}
                            </span>
                    </a>
                </li>

                <x-navbars.navs.langSwitcher></x-navbars.navs.langSwitcher>

                <li class="nav-item dropdown ps-3 pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
