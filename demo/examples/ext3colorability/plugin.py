import dlvhex

def edge():
	dlvhex.output((2, 4))
	dlvhex.output((2, 3))
	dlvhex.output((3, 5))
	dlvhex.output((4, 6))
	dlvhex.output((4, 5))
	dlvhex.output((5, 7))
	dlvhex.output((6, 7))

# register all external atoms
def register():
	# edge has no input and binary output
	dlvhex.addAtom("edge", (), 2)
