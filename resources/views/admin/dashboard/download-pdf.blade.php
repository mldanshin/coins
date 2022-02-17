<?php
/**
 * @var int $coinId
 */
?>
<a class="button"
    href="{{ route('download.document', ['type' => 'pdf', 'coin' => $coinId]) }}"
    title="{{ __('dashboard.download-pdf.tooltip') }}"
    tabindex="0"
    >
    <img class="icon"
        src="{{ asset('img/dashboard/download-pdf.svg') }}"
        alt="{{ __('dashboard.download-pdf.image') }}">
</a>