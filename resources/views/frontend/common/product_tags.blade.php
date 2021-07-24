@php
$tag_en= App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();

$tag_hi= App\Models\Product::groupBy('product_tags_hi')->select('product_tags_hi')->get();

@endphp


<div class="sidebar-widget product-tag wow fadeInUp">
          <h3 class="section-title">Product tags</h3>
          <div class="sidebar-widget-body outer-top-xs">
            <div class="tag-list"> 
                

                @if(session()->get('language') == 'hindi') 
                    @foreach($tag_hi as $tag)
                            <a class="item active" title="Phone" href="{{url('product/tag/'.$tag->product_tags_hi)}}">
                            {{ str_replace (',',' ',$tag->product_tags_hi) }} 
                            </a>
                    @endforeach
                @else 
                    @foreach($tag_en as $tag)
                            <a class="item active" title="Phone" href="{{url('product/tag/'.$tag->product_tags_en)}}">
                            {{ str_replace (',',' ',$tag->product_tags_en) }} 
                            </a>
                    @endforeach
                @endif
                
             
            </div>
            <!-- /.tag-list --> 
          </div>
          <!-- /.sidebar-widget-body --> 
        </div>