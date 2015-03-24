<?php

kirbytext::$tags['page'] = array(
  'html' => function($tag) {
    return '<h1><a name="' . $tag->attr('page') . '">'. $tag->attr('page') . '</a></h1>';
  }
);

kirbytext::$tags['l1'] = array(
  'html' => function($tag) {
    return '<h1><a name="' . $tag->attr('l1') . '">'. $tag->attr('l1') . '</a></h1>';
  }
);

kirbytext::$tags['l2'] = array(
  'html' => function($tag) {
    return '<h2><a name="' . $tag->attr('l2') . '">'. $tag->attr('l2') . '</a></h2>';
  }
);

kirbytext::$tags['l3'] = array(
  'html' => function($tag) {
    return '<h3><a name="' . $tag->attr('l3') . '">'. $tag->attr('l3') . '</a></h3>';
  }
);

kirbytext::$tags['l4'] = array(
  'html' => function($tag) {
    return '<h4><a name="' . $tag->attr('l4') . '">'. $tag->attr('l4') . '</a></h4>';
  }
);

kirbytext::$tags['l5'] = array(
  'html' => function($tag) {
    return '<h5><a name="' . $tag->attr('l5') . '">'. $tag->attr('l5') . '</a></h5>';
  }
);

kirbytext::$tags['toc'] = array(
  'html' => function($tag) {

    $html = "";
	$cnt = 0;
    foreach($tag->page()->content() as $link) {
	  $cnt+=1;
      if($cnt==3) {
		preg_match_all("/\(l[1-5]?: .*\)/", $link, $headings);
		foreach ($headings[0] as $heading) {
			$name = preg_split("/\(l[1-5]?: /",$heading);
			$name = preg_split("/\)/",$name[1]);
			$link = normalizer_normalize( $name[0], Normalizer::FORM_C );
			$link = str_replace(" ", "%20", $link);
			$link = htmlentities($link);
			
			$number = preg_split("/\(l/",$heading);
			$number = preg_split("/: .*\)/",$number[1]);
			$number = $number[0];
			
			if($number < $tag->attr('toc'))
			{
				for ($x = 2; $x < $number; $x++) {
				  $html .= '| ';
				} 

				$html .= '<a href="#';
				$html .= $link;
				$html .= '">';
				$html .= $name[0];
				$html .= '</a>'; 
				$html .= '<br>';
			}
		}
	  }
    }

    return $html;

  }
);

?>