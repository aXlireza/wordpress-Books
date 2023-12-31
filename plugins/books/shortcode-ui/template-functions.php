<?php
function de_book_block(
    $title,
    $thumbnail_url,
    $category,
    $category_link,
    $publish_year,
    $excerpt_context,
    $author_name,
    $author_link,
    $link
    ) {
    $thumbnail_block = '';
    if (isset($thumbnail_url)) {
        $thumbnail_block = "<div class='thumbnail-cover'>
            <img src='$thumbnail_url' />
        </div>";
    }
    $publish_year = tag_book_block($publish_year);
    $cat = tag_book_block($category, $category_link);
    $author = tag_book_block($author_name, $author_link);
    $title = "<h2>$title</h2>";
    $excerpt = "<p>$excerpt_context</p>";
    
    $block = "<article class='de-book-block'>
        <nav>
            $author
            $publish_year
            $cat
        </nav>
        <a href='$link'>
            $thumbnail_block
            $title
        </a>
        $excerpt
    </article>";

    return $block;
}

function tag_book_block($text='', $link=null) {
    $thelink = '';
    if (isset($link)) $thelink = "href='$link'";
    $content = "<a $thelink class='tag'>$text</a>";
    return $content;
}

function books_filterbar($categories, $req_category) {
    $options = '';
    foreach ($categories as $category)
        $options .= books_filterbar_option($category, $req_category == $category->slug);

    return "<div class='books-filter'>
        <label for='category-filter'>Filter by Category:</label>
        <select class='category-filter'>
            <option value=''>All Categories</option>
            $options
        </select>
    </div>";
}

function books_filterbar_option($category, $selected) {
    $slug = esc_attr($category->slug);
    $name = esc_html($category->name);
    $selected = $selected ? "selected='$selected'" : "";
    return "<option value='$slug' $selected>$name</option>";
}