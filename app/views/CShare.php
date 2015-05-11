<?php
    /*
    <div class="share-btn">
        <ul class="share-buttons">
            <li><a href="https://www.facebook.com/sharer/sharer.php?u=https://titan.csit.rmit.edu.au/~s3518495/wp/a3/;t=" target="_blank" title="Share on Facebook"><i class="fa fa-facebook-square fa-2x"></i></a></li>
            <li><a href="https://twitter.com/intent/tweet?source=https://titan.csit.rmit.edu.au/~s3518495/wp/a3/;text=:%20" target="_blank" title="Tweet"><i class="fa fa-twitter-square fa-2x"></i></a></li>
            <li><a href="https://plus.google.com/share?url=https://titan.csit.rmit.edu.au/~s3518495/wp/a3/" target="_blank" title="Share on Google+"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
            <li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://titan.csit.rmit.edu.au/~s3518495/wp/a3/;title=&amp;summary=&amp;source=" target="_blank" title="Share on LinkedIn"><i class="fa fa-linkedin-square fa-2x"></i></a></li>
        </ul>
    </div>
    */
    $links = array(
        'Facebook' => array('url'=>'https://www.facebook.com/sharer/sharer.php?u=https://titan.csit.rmit.edu.au/~s3518495/wp/a3/;t=',
            'target'=>'_blank',
            'title'=>'Share on Facebook',
            'class'=>'fa fa-facebook-square fa-2x'),
        'Twitter' => array('url'=>'https://twitter.com/intent/tweet?source=https://titan.csit.rmit.edu.au/~s3518495/wp/a3/;text=:%20',
            'target'=>'_blank',
            'title'=>'Tweet',
            'class'=>'fa fa-twitter-square fa-2x'),
        'Google' => array('url'=>'https://plus.google.com/share?url=https://titan.csit.rmit.edu.au/~s3518495/wp/a3/',
            'target'=>'_blank',
            'title'=>'Share on Google+',
            'class'=>'fa fa-google-plus-square fa-2x'),
        'LinkedIn' => array('url'=>'http://www.linkedin.com/shareArticle?mini=true&amp;url=https://titan.csit.rmit.edu.au/~s3518495/wp/a3/;title=&amp;summary=&amp;source=',
            'target'=>'_blank',
            'title'=>'Share on LinkedIn',
            'class'=>'fa fa-linkedin-square fa-2x'),
    );
    class CShare {
        public static function GenerateShareBtn($items) {
            $html = "<div class='share-btn'>\n";
            $html  .= "<ul class='share-buttons'>\n";
            foreach($items as $item) {
                $html .= "<li><a href='{$item['url']}' target='{$item['target']}' title='{$item['title']}'><i class='{$item['class']}'></i></a></li>\n";
            }
            $html .= "</ul>\n";
            $html .= "</div>\n";
            return $html;
        }
    }
?>