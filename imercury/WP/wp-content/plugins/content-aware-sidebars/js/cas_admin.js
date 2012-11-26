/**
 * @package Content Aware Sidebars
 * @author Joachim Jensen <jv@intox.dk>
 */

jQuery( "#cas-accordion" ).accordion({
	header: 'h4',
	autoHeight: false,
	collapsible: true
});

jQuery(document).ready(function($) {
        
        handleAllCheckbox("post_types","posttype");
        handleAllCheckbox("taxonomies","taxonomy");
        handleAllCheckbox("authors","list");
        handleAllCheckbox("page_templates","list");
        
        handleSidebarHandle();
        
	/**
	 *
	 * Set tickers
	 *
	 */
	$('.cas-rule-content :input').each( function() {
		$(this).parents('.cas-rule-content').prev().toggleClass('cas-tick',$('#'+$(this).parents('.cas-rule-content').attr('id')+' :input:checked').length > 0);	
	});
	$('.cas-rule-content :input').change( function() {
		$(this).parents('.cas-rule-content').prev().toggleClass('cas-tick',$('#'+$(this).parents('.cas-rule-content').attr('id')+' :input:checked').length > 0);	
	});
        
        /**
         *
         * Handle "Show with All" checkbox
         *
         */
        function handleAllCheckbox(name,type) {
                
                var checkbox = "input[name='"+name+"[]']";
                
                // Execute on ready for each checkbox
                $(checkbox).each(function() {
                        disenableSingleCheckboxes($(this),type);
                });
                
                // Execute on change
                $(checkbox).change(function(){
                        disenableSingleCheckboxes($(this),type);
                });
        }
        
        /**
         *
         * The state of a "Show with All" checkbox will control the
         * accessibility of the respective checkboxes for specific entities
         * If state is checked, they will be disabled
         *
         */
        function disenableSingleCheckboxes(checkbox,type) {
                var checkboxes = "#"+type+"-"+checkbox.val()+" :input";

                if(checkbox.is(":checked")) {
                        $(checkboxes).attr("disabled", true);   
                } else {
                        $(checkboxes).removeAttr("disabled");  
                }
        }
        
        /**
         *
         * Handle the Handle selection
         *
         */
        function handleSidebarHandle() {
                
                var name = "select[name='handle']";
                
                // Execute on ready
                $(name).each(function(){
                        endisableHostSidebars($(this));
                });
                
                // Execute on change
                $(name).change(function(){
                        endisableHostSidebars($(this));
                });
        }
        
        /**
         *
         * The value of Handle selection will control the
         * accessibility of the host sidebar selection
         * If Handling is manual, selection of host sidebar will be disabled
         *
         */
        function endisableHostSidebars(select) {
                var name = "select[name='host']";
                if(select.val() == 2) {
                        $(name).hide();
                        $(name).attr("disabled", true);
                        
                } else {
                        $(name).show();
                        $(name).removeAttr("disabled");
                }
        }
        
});