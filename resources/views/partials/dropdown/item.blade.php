<?php
    $forModal = $forModal ?? false;
    $forSectionLoad = $forSectionLoad ?? false;
    $toggleFor = $toggleFor ?? "";
    $isDropDownBtn = $isDropDownBtn ?? false;
    $modalLink = $modalLink ?? "";
    $label = $label ?? "";
    $icon = $icon ?? "";
    $url = $url ?? "";
    $color = $color ?? "black";
    $paddingAmount = $paddingAmount ?? $isDropDownBtn ? "5" : "10";

    $dropDownAttr = "data-toggle=dropdown";
    $modalAttr = "href=$modalLink data-toggle=modal";
    $pageAttr = "data-role-ajax=$url";
    $sectionAttr = "data-role-ajaxSection=$url";

    $attr = $isDropDownBtn ? $dropDownAttr : ($forModal ? $modalAttr : ($forSectionLoad ? $sectionAttr : $pageAttr));
?>

<a {{ $attr }} class="no-decor {{$isDropDownBtn ? 'dropdown-toggle' : ''}}">
    <li class="padding-{{$paddingAmount}} no-decor fc-grey fs-18 ellipsis {{$color}} {{ $isDropDownBtn ? 'dropDownBtn' : '' }}">
        <span class="inline-block text-center" style="min-width:25px;">
            <i class="fas fa-{{$icon}}"></i>
        </span>
        {{$label}}
    </li>
</a>
