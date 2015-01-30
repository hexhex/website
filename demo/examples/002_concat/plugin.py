import dlvhex

# concat has one input parameter of type tuple, which consists of terms to be concatenated
def concat(tup):
	x = ""
	for x in tup:
		ret = ret + x.getValue()
	dlvhex.output((x, ))

# register all external atoms
def register():
	dlvhex.addAtom("concat", (dlvhex.TUPLE, ), 1)
