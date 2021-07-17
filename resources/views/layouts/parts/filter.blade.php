@section('filter')
<div id="accordion">
    <div class="filters-card border-bottom p-3">
       <div class="filters-card-header" id="headingTwo">
          <h6 class="mb-0">
             <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
             Genre
             <i class="fas fa-angle-down float-right"></i>
             </a>
          </h6>
       </div>
       <div id="collapsetwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="filters-card-body card-shop-filters">
             {{-- <form class="filters-search mb-3">
                <div class="form-group">
                   <i class="fas fa-search"></i>
                   <input type="text" class="form-control" placeholder="Start typing to search...">
                </div>
             </form> --}}
             @foreach ($genres as $genre)
               <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="genre-{{ $genre->id }}">
                  <label class="custom-control-label" for="genre-{{ $genre->id }}">{{ $genre->title }}</label>
               </div>
             @endforeach
          </div>
       </div>
    </div>
    <div class="filters-card border-bottom p-3">
       <div class="filters-card-header" id="headingOne">
          <h6 class="mb-0">
             <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
             Select Language <i class="fas fa-angle-down float-right"></i>
             </a>
          </h6>
       </div>
       <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="filters-card-body card-shop-filters">
             @foreach ($languages as $language)
               <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="language-{{ $language->id }}">
                  <label class="custom-control-label" for="language-{{ $language->id }}">{{ $language->title }}</label>
               </div>
             @endforeach
          </div>
       </div>
    </div>
    <div class="filters-card border-bottom p-3">
       <div class="filters-card-header" id="headingOffer">
          <h6 class="mb-0">
             <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOffer" aria-expanded="true" aria-controls="collapseOffer">
             Format <i class="fas fa-angle-down float-right"></i>
             </a>
          </h6>
       </div>
       <div id="collapseOffer" class="collapse" aria-labelledby="headingOffer" data-parent="#accordion">
          <div class="filters-card-body card-shop-filters">
             @foreach ($categories as $category)
               <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="category-{{ $category->id }}">
                  <label class="custom-control-label" for="category-{{ $category->id }}">{{ $category->title }}</label>
               </div>
            @endforeach
          </div>
       </div>
    </div>
 </div>
@endsection