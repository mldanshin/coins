<section class="coin-card">
    <h2 class="text-center">
        <x-coin-title :model="$model->title" />
    </h2>
    <x-picture class="picture-reader" :model="$model->picture" width="140" />
    @include("partials.coin-table", ["coin" => $model])
</section>