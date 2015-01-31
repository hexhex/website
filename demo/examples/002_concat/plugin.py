import dlvhex

# This is a minimal plugin to be used as a template
# for first experiments with custom plugins.

# concat has one input parameter of type tuple,
# which consists of terms to be concatenated
def concat(tup):
	ret = ""
	for x in tup:
		ret = ret + x.value()
	dlvhex.output((ret, ))

# register all external atoms
def register():
	dlvhex.addAtom("concat", (dlvhex.TUPLE, ), 1)
