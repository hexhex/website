/**
 * HEX syntax v 1.0
 * 
 * v1.0 Christop Redl (01/2015)
 *   
**/
editAreaLoader.load_syntax["hex"] = {
	'DISPLAY_NAME' : 'HEX'
	,'COMMENT_SINGLE' : {1 : '%'}
	,'COMMENT_MULTI' : {}
	,'QUOTEMARKS' : {1: "'", 2: '"'}
	,'KEYWORD_CASE_SENSITIVE' : true
	,'KEYWORDS' : {
		/*
		** Set 1: reserved words
		*/
		'reserved' : [
			'v'
		]
		/*
		** Set 2: builtins
		*/	
		,'builtins' : [
			'#int', '#min', '#max', '#avg', '#count'
		]
		/*
		** Set 3: standard library
		*/
		,'stdlib' : [
		]
		/*
		** Set 4: special methods
		*/
		,'special' : [
			// Basic customization:
			'&'
		]
	}
	,'OPERATORS' :[
		'+', '-', '/', '*', '=', '!=', '<', '>', '<=', '>='
	]
	,'DELIMITERS' :[
		'(', ')', '[', ']', '{', '}'
	]
	,'STYLES' : {
		'COMMENTS': 'color: #AAAAAA;'
		,'QUOTESMARKS': 'color: #660066;'
		,'KEYWORDS' : {
			'reserved' : 'color: #0000FF;'
			,'builtins' : 'color: #009900;'
			,'stdlib' : 'color: #009900;'
			,'special': 'color: #006666;'
			}
		,'OPERATORS' : 'color: #993300;'
		,'DELIMITERS' : 'color: #993300;'
				
	}
};
