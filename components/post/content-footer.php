<?php if ( is_single() ) : ?>
	<footer class="entry-footer single-footer">
		<?php bookmark_entry_footer(); ?>
	</footer><!-- .entry-footer -->
<?php elseif ( comments_open() || get_comments_number() ) : ?>
	<footer class="entry-footer not-single-footer">
		<?php bookmark_entry_footer(); ?>
	</footer><!-- .entry-footer -->
<?php else : ?>
	<footer class="entry-footer">
		<?php bookmark_entry_footer(); ?>
	</footer><!-- .entry-footer -->
<?php endif; ?>