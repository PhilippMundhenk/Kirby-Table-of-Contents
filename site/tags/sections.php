<?php

/* 
   This function determines the splitchar and lowercase parameters in the (toc: ) tag
   we have to pass also the $tag argument
*/
function getparams($tag, &$sc, &$lc) {
	
	// Default values
	$splitchar = '%20';			// spaces get replaced by this character
	$lowercase = 0;				// default lowercase

	// search the text field of the current page
	$text = $tag->page()->text();

	preg_match_all("/\(toc: .*\)/", $text, $tocs);

	foreach ($tocs[0] as $toc) {
		// determine the lowercase parameter 
		preg_match_all("/lowercase:(\ )?[0,1]?/", $toc, $parameters);
		foreach ($parameters[0] as $param) {
			$param = preg_replace("/lowercase:/", "", $param);
			$param = preg_replace("/\ /", "", $param);

			if($param==1)
				$lowercase=1;
			else
				$lowercase=0;
		}

		// determine the  splitchar parameter 
		$splitchar = '%20';
		preg_match_all("/split:(\ )?./", $toc, $parameters);
		foreach ($parameters[0] as $param) {
			$param = preg_replace("/split:(\ )?/", "", $param);
			$param = preg_replace("/\ ./", "", $param);
			$splitchar = $param;
		}
	}

	$sc = $splitchar;
	$lc = $lowercase;
}

/********************************************************************************************/
/*  
	The following functions replace the (lx: ) tags by a headline of the respective size, 
	containing also a named anchor.
*/
/********************************************************************************************/
kirbytext::$tags['l1'] = array(
  'attr' => array(
  ),
  'html' => function($tag) {

	getparams($tag, $splitchar, $lowercase);		// Get splitchar and lowercase params

   $link = $tag->attr('l1');							// get the "l1:"  tag attribute
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$link = str_replace(" ", $splitchar, $link);

  	if($lowercase==1) 
		$link = strtolower($link);
	
    return '<h1><a name="' . $link . '">'. $tag->attr('l1') . '</a></h1>';
  }
);

kirbytext::$tags['l2'] = array(
  'attr' => array(
  ),
  'html' => function($tag) {

	getparams($tag, $splitchar, $lowercase);		// Get splitchar and lowercase params

	$link = $tag->attr('l2');
	$link = preg_replace("/[^ \w]+/", "", $link);
	$link = str_replace(" ", $splitchar, $link);

	if($lowercase==1) 
		$link = strtolower($link);

   return '<h2><a name="' . $link . '">'. $tag->attr('l2') . '</a></h2>';
  }
);

kirbytext::$tags['l3'] = array(
  'attr' => array(
  ),
  'html' => function($tag) {

	getparams($tag, $splitchar, $lowercase);		// Get splitchar and lowercase params

  	$link = $tag->attr('l3');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$link = str_replace(" ", $splitchar, $link);

  	if($lowercase==1) 
		$link = strtolower($link);

    return '<h3><a name="' . $link . '">'. $tag->attr('l3') . '</a></h3>';
  }
);

kirbytext::$tags['l4'] = array(
  'attr' => array(
  ),
  'html' => function($tag) {

	getparams($tag, $splitchar, $lowercase);		// Get splitchar and lowercase params

  	$link = $tag->attr('l4');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$link = str_replace(" ", $splitchar, $link);

  	if($lowercase==1) 
		$link = strtolower($link);

    return '<h4><a name="' . $link . '">'. $tag->attr('l4') . '</a></h4>';
  }
);

kirbytext::$tags['l5'] = array(
  'attr' => array(
  ),
  'html' => function($tag) {

	getparams($tag, $splitchar, $lowercase);		// Get splitchar and lowercase params

  	$link = $tag->attr('l5');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$link = str_replace(" ", $splitchar, $link);

  	if($lowercase==1) 
		$link = strtolower($link);

    return '<h5><a name="' . $link . '">'. $tag->attr('l5') . '</a></h5>';
  }
);

kirbytext::$tags['l6'] = array(
  'attr' => array(
  ),
  'html' => function($tag) {

	getparams($tag, $splitchar, $lowercase);		// Get splitchar and lowercase params
	
  	$link = $tag->attr('l6');
  	$link = preg_replace("/[^ \w]+/", "", $link);
  	$link = str_replace(" ", $splitchar, $link);

  	if($lowercase==1) 
		$link = strtolower($link);

    return '<h6><a name="' . $link . '">'. $tag->attr('l6') . '</a></h6>';
  }
);

kirbytext::$tags['toc'] = array(
  'attr' => array(							// attributes, passed to the tag
    'split',
    'lowercase',
    'levelchar'
  ),
  'html' => function($tag) {
/*
	This function replaces the (toc: ) tag by the TOC, containing links to the headline anchors.
	
	Supports the following params:
	(toc:6 split: - lowercase: 1 levelchar: >)

	- split: Allows to change the replacement character for a space, example usage: split: -
	- lowercase: Allows to change all letters in the link to lowercase, usage: lowercase: 1
	- levelchar: Allows to change the character used to separate different levels in the table of contents, 
					 usage: levelchar: > or levelchar: space

*/
	$html = "";												// the return string

	// preparing the parameters. If not given, the default values will be used
	$splitchar = $tag->attr('split', "%20");
	$levelchar = $tag->attr('levelchar', '|');
	$lowercase = $tag->attr('lowercase', '0');

	if(!strcmp($levelchar, 'space')) 
		$levelchar="&nbsp;";

	// Scan the text field of the current page
	$text = $tag->page()->text();

	// Scan for all lines containing "(l[1-6]: ... )"
	preg_match_all("/\(l[1-6]?: .*\)/", $text, $headings);	

	// $headings[0] returns an array with the found lines
	foreach ($headings[0] as $heading) {
		// Process any headline
		// remove "lx:"
		$name = preg_split("/\(l[1-6]?: /",$heading);
		$name = preg_split("/\)/",$name[1]);
		$link = $name[0];

		// replace whitespaces by splitchar 
		$link = preg_replace("/[^ \w]+/", "", $link);
		$link = str_replace(" ", $splitchar, $link);
		$link = htmlentities($link);								// a PHP function

		// determine the headline depth
		$number = preg_split("/\(l/",$heading);
		$number = preg_split("/: .*\)/",$number[1]);
		$number = $number[0];

		// change to lowercase 
		if($lowercase == 1) 
			$link = strtolower($link);

		// we only return the headlines up to the given depth
		if($number <= $tag->attr('toc'))	{						// the "toc:" parameter, e.g. 6

			// output the levelchar as much as wanted
			for ($x = 1; $x < $number; $x++) {
			  $html .= $levelchar . ' ';
			}

			$name = $name[0];											// link name from above

			// HTML Code erzeugen
			$html .= '<a href="#';
			$html .= $link;
			$html .= '">';
			$html .= $name;
			$html .= '</a>';
			$html .= '<br>';
			//$html .= "\n\r";
		}	//_if

	}	//_foreach

    return $html;
  }
);

?>