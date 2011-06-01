if (cfSettings == undefined) var cfSettings = {};
if (cfInstances == undefined) var cfInstances = {};

function Carboform(id, opt) {
    // If element does not exist, return
    if (!$('#' + id).length) return false;

    // Public members
    this.id = id;
    this.container = $('#' + id);

    // Private members
    var context = this.container[0];
    var me = this;
    var settings = opt;

    this.init = function() {
        this.load();
    }

    this.load = function() {
        // Init show/hide sections
        $('.cg-group-header', context).disableSelection();
        $('.cg-group-header .ui-icon', context).click(function() {
            $(this).closest('.cg-group').find('.cg-group-content').slideToggle();
            $(this).toggleClass('ui-icon-triangle-1-s ui-icon-triangle-1-e');
        });
        $('.cg-group-header', context).dblclick(function() {
            $(this).closest('.cg-group').find('.cg-group-content').slideToggle();
            $('.ui-icon', this).toggleClass('ui-icon-triangle-1-s ui-icon-triangle-1-e');
        });
        // Init datepickers
        $('.cg-datepicker', context).datepicker();
    }

    this.init();
}

$(function() {
    // Init forms if any
    for (var id in cfSettings) {
        cfInstances[id] = new Carboform('carboform_' + id, cfSettings[id]);
    }
});

/*$(document).ready(function() {
	var baseUrl = $('.form-base-url').text();

	// Init show/hide sections
	$('.cg-group-header').disableSelection();
	$('.cg-group-header .ui-icon').click(function() {
		$(this).closest('.cg-group').find('.cg-group-content').slideToggle();
		$(this).toggleClass('ui-icon-triangle-1-s ui-icon-triangle-1-e');
	});
	$('.cg-group-header').dblclick(function() {
		$(this).closest('.cg-group').find('.cg-group-content').slideToggle();
		$('.ui-icon', this).toggleClass('ui-icon-triangle-1-s ui-icon-triangle-1-e');
	});
	// Init datepickers
	$('.cg-datepicker').datepicker();
	// Disable empty dropdowns
	$('.cg-form select').each(function() {
		if ($('option', this).length == 1) $(this).attr('disabled', 'disabled');
	});
	$('.cg-filter').live('change', function() {
		var nr = $(this).data('nr') - 0;
		var name = $(this).data('name');
		var filter = $(this).data('filter');
		var value = $(this).val();
		var target = $('#cm_field_' + name + '_filter' + (nr + 1)).length ? $('#cm_field_' + name + '_filter' + (nr + 1)) : $('#cm_field_' + name);
		var table = target.data('table');
		var field = target.data('field');
		var type = target.data('type');
		// Disable further filters
		var i = nr + 1;
		while ($('#cm_field_' + name + '_filter' + i).length) {
			$('#cm_field_' + name + '_filter' + i).val('').attr('disabled', 'disabled');
			i++;
		}
		$('#cm_field_' + name).val('').attr('disabled', 'disabled');
		// Get data
		$.post(baseUrl + 'carbogrid/ajax/get_dropdown',
			{
				table: table,
				field: field,
				type: type,
				filter: filter,
				value: value
			},
			function(resp) {
				target.html(resp);
				if ($('option', target).length > 1) target.attr('disabled', '');
		});
	});
});*/
