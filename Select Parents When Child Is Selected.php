add_action('admin_footer', function() {
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.categorydiv input[type="checkbox"]').forEach(function (checkbox) {
            checkbox.addEventListener("change", function () {
                let isChecked = this.checked;

                // Select Parent Categories
                if (isChecked) {
                    checkParentNodes(this);
                } else {
                    checkChildNodes(this);
                }
            });
        });

        function checkParentNodes(childCheckbox) {
            let parentLabel = childCheckbox.closest("ul").closest("li").querySelector("input[type='checkbox']");
            if (parentLabel) {
                parentLabel.checked = true;
                checkParentNodes(parentLabel);
            }
        }

        function checkChildNodes(parentCheckbox) {
            let childCheckboxes = parentCheckbox.closest("li").querySelectorAll("ul input[type='checkbox']");
            childCheckboxes.forEach(child => {
                child.checked = false;
                checkChildNodes(child);
            });
        }
    });
    </script>
    <?php
});

add_action('set_object_terms', 'auto_select_parent_terms', 9999, 6);

function auto_select_parent_terms($object_id, $terms, $tt_ids, $taxonomy, $append, $old_tt_ids) {
    if (empty($tt_ids)) return;

    foreach ($tt_ids as $term_id) {
        $term = get_term($term_id, $taxonomy);
        if (!is_wp_error($term) && !empty($term->parent)) {
            wp_set_post_terms($object_id, [$term->parent], $taxonomy, true);
        }
    }
}
