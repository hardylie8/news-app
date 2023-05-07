<li class="nav-item dropdown ps-3 pe-2 d-flex align-items-center">
    <a href="#" class="nav-link text-body p-0 active"  data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
        @if(App::getLocale() == "id")
        <x-flag-country-id width="24" height="24"/> 
        @elseif(App::getLocale() == "en")  
        <x-flag-country-gb width="24" height="24"/> 
        @endif
        {{ strtoupper(App::getLocale()) }}
    </a>
    <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4  " aria-labelledby="navbarDropdownMenuLink2">
        <li>
            <a class="dropdown-item active" href="/lang/id">
                <x-flag-country-id width="16" height="16"/> Indonesia
            </a>
        </li>
        <li>
            <a class="dropdown-item"href="/lang/en">
                <x-flag-country-gb  width="16" height="16"/> English(UK)
            </a>
        </li>
      
    </ul>
</li>
{{-- 
<div class="dropdown">
    <a href="#" class="btn bg-gradient-dark dropdown-toggle " data-bs-toggle="langSwitcher" id="langSwitcher">
       EN
    </a>
    <ul class="dropdown-menu" aria-labelledby="langSwitcher">
        <li>
            <a class="dropdown-item"  href="/lang/id">
                Indonesia
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="#">
                English
            </a>
        </li>

    </ul>
  </div> --}}