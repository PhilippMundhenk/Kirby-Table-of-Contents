<?php

kirbytext::$tags['l1'] = array(
  'attr' => array(
    'split',
    'lowercase'
  ),
  'html' => function($tag) {
  	$link = $tag->attr('l1');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$splitchar = $tag->attr('split', "%20");
  	$link = str_replace(" ", $splitchar, $link);
  	if($tag->attr('lowercase')==1) {
		$link = strtolower($link);
	}
    return '<h1><a name="' . $link . '">'. $tag->attr('l1') . '</a></h1>';
  }
);

kirbytext::$tags['l2'] = array(
  'attr' => array(
    'split',
    'lowercase'
  ),
  'html' => function($tag) {
  	$link = $tag->attr('l2');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$splitchar = $tag->attr('split', "%20");
  	$link = str_replace(" ", $splitchar, $link);
  	if($tag->attr('lowercase')==1) {
		$link = strtolower($link);
	}
    return '<h2><a name="' . $link . '">'. $tag->attr('l2') . '</a></h2>';
  }
);

kirbytext::$tags['l3'] = array(
  'attr' => array(
    'split',
    'lowercase'
  ),
  'html' => function($tag) {
  	$link = $tag->attr('l3');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$splitchar = $tag->attr('split', "%20");
  	$link = str_replace(" ", $splitchar, $link);
  	if($tag->attr('lowercase')==1) {
		$link = strtolower($link);
	}
    return '<h3><a name="' . $link . '">'. $tag->attr('l3') . '</a></h3>';
  }
);

kirbytext::$tags['l4'] = array(
  'attr' => array(
    'split',
    'lowercase'
  ),
  'html' => function($tag) {
  	$link = $tag->attr('l4');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$splitchar = $tag->attr('split', "%20");
  	$link = str_replace(" ", $splitchar, $link);
  	if($tag->attr('lowercase')==1) {
		$link = strtolower($link);
	}
    return '<h4><a name="' . $link . '">'. $tag->attr('l4') . '</a></h4>';
  }
);

kirbytext::$tags['l5'] = array(
  'attr' => array(
    'split',
    'lowercase'
  ),
  'html' => function($tag) {
  	$link = $tag->attr('l5');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$splitchar = $tag->attr('split', "%20");
  	$link = str_replace(" ", $splitchar, $link);
  	if($tag->attr('lowercase')==1) {
		$link = strtolower($link);
	}
    return '<h5><a name="' . $link . '">'. $tag->attr('l5') . '</a></h5>';
  }
);

kirbytext::$tags['l6'] = array(
  'attr' => array(
    'split',
    'lowercase'
  ),
  'html' => function($tag) {
  	$link = $tag->attr('l6');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$splitchar = $tag->attr('split', "%20");
  	$link = str_replace(" ", $splitchar, $link);
  	if($tag->attr('lowercase')==1) {
		$link = strtolower($link);
	}
    return '<h6><a name="' . $link . '">'. $tag->attr('l6') . '</a></h6>';
  }
);

kirbytext::$tags['toc'] = array(
  'attr' => array(
    'split',
    'lowercase'
  ),
  'html' => function($tag) {

    $html = "";
	$cnt = 0;
	$splitchar = $tag->attr('split', "%20");
    foreach($tag->page()->content() as $link) {
	  $cnt+=1;
      if($cnt==3) {
		preg_match_all("/\(l[1-6]?: .*\)/", $link, $headings);
		foreach ($headings[0] as $heading) {
			$name = preg_split("/\(l[1-6]?: /",$heading);
			$name = preg_split("/\)/",$name[1]);
			$link = $name[0];
			$link = preg_replace("/\ split: ./", "", $link);
			$link = preg_replace("/\ lowercase: \d/", "", $link);
			// $link = normalizer_normalize( $name[0], Normalizer::FORM_C );
			$link = preg_replace("/[^ \w]+/", "", $link);
			$link = str_replace(" ", $splitchar, $link);
			$link = htmlentities($link);
			if($tag->attr('lowercase')==1) {
				$link = strtolower($link);
			}

			$number = preg_split("/\(l/",$heading);
			$number = preg_split("/: .*\)/",$number[1]);
			$number = $number[0];

			if($number <= $tag->attr('toc'))
			{
				for ($x = 2; $x < $number; $x++) {
				  $html .= '| ';
				}

				$name = preg_replace("/\ split: ./", "", $name[0]);
				$name = preg_replace("/\ lowercase: \d/", "", $name);

				$html .= '<a href="#';
				$html .= $link;
				$html .= '">';
				$html .= $name;
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