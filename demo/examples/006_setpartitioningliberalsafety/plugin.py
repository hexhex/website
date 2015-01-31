import dlvhex

# computes the set of all elements in the extension
# of unary predicate p but not in that of q
def setdiff(p,q):
	# for all input atoms (over p or q)
	for x in dlvhex.getTrueInputAtoms():
		# check if the predicate is p
		if x.tuple()[0] == p:
			# check if the atom with predicate
			# being changed to q is NOT in the input
			if dlvhex.isFalse(dlvhex.storeAtom((q, x.tuple()[1]))):
				# then the element is in the output
				dlvhex.output((x.tuple()[1], ));

# register all external atoms
def register():
	prop = dlvhex.ExtSourceProperties()
	# setdiff is monotonic in input predicate 0 and antimonotonic in input predicate 1
	prop.addMonotonicInputPredicate(0)
	prop.addAntimonotonicInputPredicate(1)
	# output element 0 can only contain values which appear in the input
	prop.addRelativeFiniteOutputDomain(0, 0)
        prop.addRelativeFiniteOutputDomain(0, 1)
	# setdiff has two predicate input parametrers and its output arity is 1
	dlvhex.addAtom("setdiff", (dlvhex.PREDICATE, dlvhex.PREDICATE), 1, prop)
