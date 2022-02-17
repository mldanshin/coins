<div class="flex-column align-items-center">
    <x-picture class="picture-short" :model="$model->picture" width="70" />
    <div>
        <span>{{ $model->title->nominal }}</span>
        <span>{{ $model->title->currency }}</span>
        <span>{{ $model->title->year }}</span>
    </div>
</div>