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
    $subLabel = $subLabel ?? "";
    $hasSubLabel = !empty($subLabel) && $isPostSeason;
    $styleForSubLabel = $hasSubLabel ? 'style=line-height:15px' : '';

    $dropDownAttr = "data-toggle=dropdown";
    $modalAttr = "href=$modalLink data-toggle=modal";
    $pageAttr = "data-role-ajax=$url";
    $sectionAttr = "data-role-ajaxSection=$url";

    $attr = $isDropDownBtn ? $dropDownAttr : ($forModal ? $modalAttr : ($forSectionLoad ? $sectionAttr : $pageAttr));
?>

<a {{ $attr }} class="dropdown-item no-decor {{$isDropDownBtn ? 'dropdown-toggle' : ''}}">
    <li {{$styleForSubLabel}} class="padding-{{$paddingAmount}} no-decor fc-grey fs-18 ellipsis {{$color}} {{ $isDropDownBtn ? 'dropDownBtn' : '' }}">
        <span class="inline-block text-center" style="min-width:25px;">
            <i class="fas fa-{{$icon}}"></i>
        </span>
        {{$label}}
        @if($hasSubLabel)
            <div class="subLabel">{{$subLabel}}</div>
        @endif
    </li>
</a>
