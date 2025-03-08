@props(['active'=>true, 'class', 'href'=>'#', 'title'=>''])
<a href={{ $href }} class="{{ $class??'' }} {{(!$active)? 'hidden':''}}" title={{$title}}>
    {{ $slot }}
</a>