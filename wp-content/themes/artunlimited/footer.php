<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package artunlimited
 */
?>

	</div><!-- #main -->

    </div><!-- #home -->
	
	</div><!-- #page -->

	<?php wp_footer(); ?>
        
        <div class="page-loader">
            <div class="spinner"></div>
        </div>


        <script>
            jQuery(function() {
                var state = new work.models.State();

                var vent = _.extend({}, Backbone.Events);

                var navigation = new work.views.Navigation({
                    el: '#navigation',
                    state: state,
                    vent: vent
                });

                var page = new work.views.Page({
                    el: '#page',
                    state: state,
                    vent: vent,
                    navigation: navigation
                });

                var router = new work.Router({
                    state: state
                });

                Backbone.history.start({
                    pushState: true,
                    oldie: $.browser.msie && parseInt($.browser.version, 10) <= 7
                });

                $.get('http://fast.fonts.com/t/1.css?apiType=css&projectid=e87109b8-b520-484f-bd45-74c64d11cefc');
            });
        </script>


</body>
</html>
