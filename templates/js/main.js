$(document).ready(function() {
	var AJAX = "/ajax.php";
	
	function __init() {
		buttons();
		popupInit();
	}
	
	function popupInit() {
		$(".popup").on("click", function(e) {
			var container = $(".popup__box");
			if (container.has(e.target).length === 0){
				$(".popup").removeClass("popup_active");
			}
		});
		$(".popup__close").on("click", function() {
			$(".popup").removeClass("popup_active");
		});
	
	}
	
	function buttons() {
		$(".button").on("click", function() {
			$(".popup").addClass("popup_active");
			$(".popup__title").text("Добавить запись");
			$(".popup [name=name]").val("");
			$(".popup [name=price]").val("");
			$(".popup [name=cat]").val(1);
			$(".popup [name=id]").val("");
			$("[type=submit]").on("click", function(e) {
				e.preventDefault();
				var formData = $(".popup__form").serialize();
				formData += "&action=add";
				$.post(AJAX, formData, function(data) {
					var updateData = $.parseJSON(data);
					$(".table").append(""
					+ '<div class="table__row">'
					+   '<div class="table__col table__col_id">'
					+		'' + updateData.id
					+   '</div>'
					+   '<div class="table__col table__col_name">'
					+		'' + updateData.name
					+	'</div>'
					+   '<div class="table__col table__col_cat">'
					+		'' + updateData.cat
					+	'</div>'
					+   '<div class="table__col table__col_price">'
					+		'' + updateData.price
					+	'</div>'
					+   '<div class="table__col table__col_config" data-id="'+updateData.id+'">'
					+	'Редактировать'
					+	'</div>'
					+	'<div class="table__col table__col_delete" data-id="'+updateData.id+'">'
					+	'Удалить'
					+	'</div>'
					+ '</div>'
					);
					$(".popup").removeClass("popup_active");
				});
			});
		});
		
		
		$(".table__col_config").on("click", function() {
			$(".popup").addClass("popup_active");
			$(".popup__title").text("Редактировать запись");
			var id = $(this).attr("data-id");
			$.post(AJAX, {id: id, action: "sel"}, function(data, status, xhr) {
				var d = $.parseJSON(data);
				$(".popup [name=name]").val(d.name);
				$(".popup [name=price]").val(d.price);
				$(".popup [name=cat]").val(d.cat_id);
				$(".popup [name=id]").val(d.id);
			});
			$("[type=submit]").on("click", function(e) {
				e.preventDefault();
				var formData = $(".popup__form").serialize();
				formData += "&action=update";
				$.post(AJAX, formData, function(data) {
					var updateData = $.parseJSON(data);
					var p = $(".table__col_config[data-id="+updateData.id+"]").parent();
					p.find(".table__col_name").text(updateData.name);
					p.find(".table__col_price").text(updateData.price);
					p.find(".table__col_cat").text(updateData.cat);
					$(".popup").removeClass("popup_active");
				});
			});
		});
		
		$(".table__col_delete").on("click", function() {
			var id = $(this).attr("data-id");
			$.post(AJAX, {id: id, action: "delete"}, function(data, status, xhr) {
				var d = $.parseJSON(data);
				var p = $(".table__col_delete[data-id="+d.id+"]").parent();
				$(p).remove();
			});
		});
	}
	
	
	__init();
});