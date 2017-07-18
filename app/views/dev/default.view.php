<div class="rightColumn">
    <div class="block">
        <header class="white">
            <h2>@@text_header</h2>
        </header>
        <div class="contentBox clearfix">
            @@foreach products as product
            <p>@@product->name</p>
            <p>@@product->unit</p>
            <p>@@product->price</p>
            @@endforeach

            @@foreach categories as category
            <p>@@category->name</p>
            @@endforeach
        </div>
        <footer>
            <p>
                @@text_footer
            </p>
        </footer>
    </div>
</div>