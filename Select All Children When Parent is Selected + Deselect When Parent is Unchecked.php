// Code for "occasions" - Copy code below and replace "occasions" with new taxonomy
add_action('admin_footer', function() {
	global $typenow;
	$taxonomy = 'occasions';

	if ($typenow && taxonomy_exists($taxonomy)) {
		$terms = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false]);
		$children_map = [];
		$parent_map = [];

		foreach ($terms as $term) {
			if ($term->parent) {
				$parent_map[$term->term_id] = $term->parent;
			}
			$children_map[$term->parent][] = $term->term_id;
		}
		?>

		<script>
		document.addEventListener("DOMContentLoaded", function() {
			let taxonomyChildren = <?php echo json_encode($children_map); ?>;
			let taxonomyParents = <?php echo json_encode($parent_map); ?>;

			document.querySelectorAll('.categorydiv input[type="checkbox"]').forEach(checkbox => {
				checkbox.addEventListener("change", function() {
					let termID = this.value;
					let isChecked = this.checked;

					// Select/Deselect all children & grandchildren
					function toggleChildren(termID, checked) {
						if (taxonomyChildren[termID]) {
							taxonomyChildren[termID].forEach(childID => {
								let childCheckbox = document.querySelector(`.categorydiv input[value="${childID}"]`);
								if (childCheckbox) {
									childCheckbox.checked = checked;
									toggleChildren(childID, checked); // Recursively select grandchildren
								}
							});
						}
					}

					// Select all ancestors (parent, grandparent, etc.)
					function toggleParents(termID, checked) {
						let parentID = taxonomyParents[termID];
						while (parentID) {
							let parentCheckbox = document.querySelector(`.categorydiv input[value="${parentID}"]`);
							if (parentCheckbox) {
								parentCheckbox.checked = checked;
								parentID = taxonomyParents[parentID]; // Move up to the grandparent
							} else {
								parentID = null;
							}
						}
					}

					if (isChecked) {
						toggleChildren(termID, true);
						toggleParents(termID, true);
					} else {
						toggleChildren(termID, false);
					}
				});
			});
		});
		</script>

		<?php
	}
});

// 2nd Code for "locations" 
add_action('admin_footer', function() {
	global $typenow;
	$taxonomy = 'locations';

	if ($typenow && taxonomy_exists($taxonomy)) {
		$terms = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false]);
		$children_map = [];
		$parent_map = [];

		foreach ($terms as $term) {
			if ($term->parent) {
				$parent_map[$term->term_id] = $term->parent;
			}
			$children_map[$term->parent][] = $term->term_id;
		}
		?>

		<script>
		document.addEventListener("DOMContentLoaded", function() {
			let taxonomyChildren = <?php echo json_encode($children_map); ?>;
			let taxonomyParents = <?php echo json_encode($parent_map); ?>;

			document.querySelectorAll('.categorydiv input[type="checkbox"]').forEach(checkbox => {
				checkbox.addEventListener("change", function() {
					let termID = this.value;
					let isChecked = this.checked;

					// Select/Deselect all children & grandchildren
					function toggleChildren(termID, checked) {
						if (taxonomyChildren[termID]) {
							taxonomyChildren[termID].forEach(childID => {
								let childCheckbox = document.querySelector(`.categorydiv input[value="${childID}"]`);
								if (childCheckbox) {
									childCheckbox.checked = checked;
									toggleChildren(childID, checked); // Recursively select grandchildren
								}
							});
						}
					}

					// Select all ancestors (parent, grandparent, etc.)
					function toggleParents(termID, checked) {
						let parentID = taxonomyParents[termID];
						while (parentID) {
							let parentCheckbox = document.querySelector(`.categorydiv input[value="${parentID}"]`);
							if (parentCheckbox) {
								parentCheckbox.checked = checked;
								parentID = taxonomyParents[parentID]; // Move up to the grandparent
							} else {
								parentID = null;
							}
						}
					}

					if (isChecked) {
						toggleChildren(termID, true);
						toggleParents(termID, true);
					} else {
						toggleChildren(termID, false);
					}
				});
			});
		});
		</script>

		<?php
	}
});
