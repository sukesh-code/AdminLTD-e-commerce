
               <li class="nav-item dropdown">

<a id="dropdownSubMenu1" href="{{ route('select') }}"
   data-toggle="dropdown"
   class="nav-link dropdown-toggle"
   style="color:white">
   Categories
</a>

<ul class="dropdown-menu border-0 shadow">

@foreach($categories as $category)

<li>
<a href="#" class="dropdown-item">
{{ $category->title }}
</a>
</li>

@endforeach

</ul>

</li>
