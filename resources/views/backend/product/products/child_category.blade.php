@php
    $depth = $depth ?? 1;
    $value = str_repeat('-', $depth);
@endphp
<li id="{{ $child_category->id }}">{{ $value }}{{ $child_category->getTranslation('name') }}</li>
@if ($child_category->childrenCategories)
    @foreach ($child_category->childrenCategories as $childCategory)
        @include('backend.product.products.child_category', ['child_category' => $childCategory, 'depth' => $depth + 1])
    @endforeach
@endif
