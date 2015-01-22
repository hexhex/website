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
	,'OPERATORS' :[
		'v', ':-', '.'
	]
	,'DELIMITERS' :[
		'(', ')', '[', ']', '{', '}', ','
	]
	,'REGEXPS' : {
		'extat' : {
			'search' : '()(\&[a-z,A-Z][a-z,A-Z,0-9]*)()'
			,'class' : 'extat'
			,'modifiers' : 'g'
			,'execute' : 'before'
		}
                ,'aggregate' : {
                        'search' : '()(\#maxint=[0-9]*|\#int|\#sum|\#min|\#max|\#avg|\#count)()'
                        ,'class' : 'aggregate'
                        ,'modifiers' : 'g'
                        ,'execute' : 'before'
                }
		,'arithmetics' : {
			'search' : '()(\\+|\\-|\\*|\\/|\\<|\\<\\=|\\>|\\>\\=|\\=)()'
                        ,'class' : 'arithmetics'
                        ,'modifiers' : 'g'
                        ,'execute' : 'after'
		}
	}
	,'STYLES' : {
		'COMMENTS': 'color: #AAAAAA;'
		,'QUOTESMARKS': 'color: #990099;'
		,'OPERATORS' : 'color: #00AF00;'
		,'DELIMITERS' : 'color: #0000FF;'
		,'REGEXPS' : {
			'extat' : 'color: #FF0000;'
			,'aggregate' : 'color: #FF0099'
			,'arithmetics' : 'color: #FF8000'
			}
		,'EXT' : 'color: #AF0000;'
				
	}
};
