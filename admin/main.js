let timer = null;
let modalError = false;

function refreshPage() 
{
    location.reload();
}
function showAlert(alert, message, timer)
{
	$(".alert-load").load("elements/alert.php", { alert, message }, function() 
	{ 
		$(".alert-load").slideDown("fast", function() 
		{
			setTimeout(function()
			{
				$(".alert").slideUp("fast", function() { $(".alert").html(""); });
			}, timer);
		}); 
	});
}

$(document).ready(function() 
{	
	$(".modal-load").delegate("#closeModal", "click", function(e)
	{
		e.preventDefault();
		$(".modal-load").slideUp("fast", function() { $(".modal-load").html(""); $("body").removeClass("modal-open"); });
	});
	$("button#editUser").click(function(e)
	{
		e.preventDefault();
		$(this).prop("disabled", true);

		let userID = $(this).attr("data-user");

		$(".modal-load").load("elements/modals.php", { modal: "editUser", userID: userID }, function() 
		{ 
			$(".modal-load").slideDown("fast", function() 
			{ 
				$(".modal-load").css("display", "flex");
				$("body").addClass("modal-open");
				$(".modal").slideDown("fast");
				$("button#editUser").prop("disabled", false);
			}); 
		});
	});
	$("#insert_testimonial").click(function(e)
	{
		e.preventDefault();
		$(this).prop("disabled", true);

		let userID = $(this).attr("data-user");

		$(".modal-load").load("elements/modals.php", { modal: "insertTestimonial" }, function() 
		{ 
			$(".modal-load").slideDown("fast", function() 
			{ 
				$(".modal-load").css("display", "flex");
				$("body").addClass("modal-open");
				$(".modal").slideDown("fast");
				$("#insert_testimonial").prop("disabled", false);
			}); 
		});
	});
	$("button#edit_testimonial").click(function(e)
	{
		e.preventDefault();
		$(this).prop("disabled", true);

		let t_id = $(this).attr("data-testimonial");

		$(".modal-load").load("elements/modals.php", { modal: "editTestimonial", t_id: t_id }, function() 
		{ 
			$(".modal-load").slideDown("fast", function() 
			{ 
				$(".modal-load").css("display", "flex");
				$("body").addClass("modal-open");
				$(".modal").slideDown("fast");
				$("button#edit_testimonial").prop("disabled", false);
			}); 
		});
	});
	$("#add_category").click(function(e)
	{
		e.preventDefault();
		$(this).prop("disabled", true);

		$(".modal-load").load("elements/modals.php", { modal: "addCategory" }, function() 
		{ 
			$(".modal-load").slideDown("fast", function() 
			{ 
				$(".modal-load").css("display", "flex");
				$("body").addClass("modal-open");
				$(".modal").slideDown("fast");
				$("#add_category").prop("disabled", false);
			}); 
		});
	});
	$("#add_member").click(function(e)
	{
		e.preventDefault();
		$(this).prop("disabled", true);

		$(".modal-load").load("elements/modals.php", { modal: "addMember" }, function() 
		{ 
			$(".modal-load").slideDown("fast", function() 
			{ 
				$(".modal-load").css("display", "flex");
				$("body").addClass("modal-open");
				$(".modal").slideDown("fast");
				$("#add_member").prop("disabled", false);
			}); 
		});
	});
	$("button#edit_member").click(function(e)
	{
		e.preventDefault();
		$(this).prop("disabled", true);

		let member = $(this).attr("data-member");

		$(".modal-load").load("elements/modals.php", { modal: "editMember", member: member }, function() 
		{ 
			$(".modal-load").slideDown("fast", function() 
			{ 
				$(".modal-load").css("display", "flex");
				$("body").addClass("modal-open");
				$(".modal").slideDown("fast");
				$("button#edit_member").prop("disabled", false);
			}); 
		});
	});
	$("#selectServer").on("change", function() 
	{
		let serverMode = this.value;

		if (serverMode == 0)
		{
			$("#srvInfo").prop("disabled", true);
			$("#srvInfo").val("N/A");
		}
		else if (serverMode == 1)
		{
			$("#srvInfo").prop("disabled", false);
		}
	});
	$("#srvUpdate").click(function(e)
	{
		e.preventDefault();
		modalError = false;

		let mode = $("#selectServer").val();
		let info = $("#srvInfo").val();

		if (info == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "changeMode",
				mode, info
			},
			success: function(response) 
			{
				if (response == "true")
				{
					if (mode == 0) 
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully updated server mode to Normal.", 2500); 
					} 
					else if (mode == 1) 
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully updated server mode to Locked / Maintenance.", 2500);
					}
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		});
	});
	$("#btnSignIn").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let email = $("#email").val();
		let password = $("#password").val();

		if (email == "" || password == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }

		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "login",
				email, password
			},
			success: function(response) 
			{
				if (response == "true")
				{
					showAlert("success", "You have been successfully logged in as Administrator.", 2500);
					setTimeout(function()
					{
						window.location.href = "dashboard";
					}, 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "You have entered incorrect EMail or Password! Please try again..", 3500);
				}
				else if (response == "access")
				{
					showAlert("error", "You do not have permission to access this section..", 3500);
				}
			}
		});
	});
	$("#updateTitle").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let siteTitle = $("#siteTitle").val();

		if (siteTitle == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "changeTitle",
				siteTitle
			},
			success: function(response) 
			{
				if (response == "true")
				{
					showAlert("success", "You have successfully changed site title to "+siteTitle, 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("#updateFooter").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let siteFooter = $("#siteFooter").val();

		if (siteFooter == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "changeFooter",
				siteFooter
			},
			success: function(response) 
			{
				if (response == "true")
				{
					showAlert("success", "You have successfully changed footer text to "+siteFooter, 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("#uploadLogo").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let files = $("#siteLogo").prop("files")[0];
		let formData = new FormData();

		formData.append("process", "changeLogo");
		formData.append("file", files);

		if ($('#siteLogo').get(0).files.length === 0) { modalError = true; }
		
		if (modalError)
		{
			showAlert("error", "Please fill up all fields.", 2500);
			return true;
		}
		else
		{
			$.ajax(
			{
				url: "process.php",
				type: "POST",
				dataType: 'script',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(response)
				{
					if (response == "true")
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully changed site logo.", 2500);
					}
					else if (response == "false")
					{
						showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
					}
				}
			});
		}
	});
	$(".modal-load").delegate("#btnSaveUser", "click", function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let id = $(this).attr("data-user-id");
		let name = $("#name").val();
		let pnumber = $("#pnumber").val();
		let bday = $("#bday").val();

		if ($("#check_access").is(":checked"))
		{
			access = "1";
		}
		else { access = "0"; }

		if ($('#check_approved').is(":checked"))
		{
	  		approved = "1";
		}
		else { approved = "0" }
		
		if (name == "" || approved == "" || access == "" || pnumber == "" || bday == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "updateUser",
				id, name, pnumber, bday, approved, access
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully updated "+name+"'s profile.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("#insert_article").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let files = $("#blog_featured").prop("files")[0];
		let author = $(this).attr("data-author");
		let title = $("#blog_title").val();
		let desc = $("#blog_desc").val();
		let category = $("#blog_category").val();
		let data = CKEDITOR.instances.blogContent.getData();

		let formData = new FormData();

		formData.append("process", "insertArticle");
		formData.append("file", files);
		formData.append("author", author);
		formData.append("title", title);
		formData.append("desc", desc);
		formData.append("category", category);
		formData.append("data", data);

		if ($('#blog_featured').get(0).files.length === 0) { showAlert("error", "Please insert featured image.", 2500); }
		if (data.length <= 7 || title == "" || desc == "" || category == null) { modalError = true; }
		
		if (modalError)
		{
			showAlert("error", "Please fill up all fields.", 2500);
			return true;
		}
		else
		{
			$.ajax(
			{
				url: "process.php",
				type: "POST",
				dataType: 'script',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(response)
				{
					if (response == "true")
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully inserted new article.", 2500);
					}
					else if (response == "false")
					{
						showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
					}
				}
			});
		}
	});
	$("#save_article").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let id = $(this).attr("data-article-id");
		let files = $("#edit_featured").prop("files")[0];
		let title = $("#edit_title").val();
		let desc = $("#edit_desc").val();
		let category = $("#edit_category").val();
		let data = CKEDITOR.instances.editBlogContent.getData();

		let formData = new FormData();

		formData.append("process", "updateArticle");
		formData.append("id", id);
		formData.append("file", files);
		formData.append("title", title);
		formData.append("desc", desc);
		formData.append("category", category);
		formData.append("data", data);

		if (data.length <= 7 || title == "" || desc == "" || category == null) { modalError = true; }
		
		if (modalError)
		{
			showAlert("error", "Please fill up all fields.", 2500);
			return true;
		}
		else
		{
			$.ajax(
			{
				url: "process.php",
				type: "POST",
				dataType: 'script',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(response)
				{
					if (response == "true")
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully updated existing article.", 2500);
					}
					else if (response == "false")
					{
						showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
					}
				}
			});
		}
	});
	$("#delete_article").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let id = $(this).attr("data-article-id");

		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "deleteArticle",
				id
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(function()
					{
						document.location.href = "blog-post";
					}, 2500);
					showAlert("success", "You have successfully deleted article with ID: "+id, 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		});
	});
	$("#insert_item").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let files = $("#item_featured").prop("files")[0];
		let title = $("#item_title").val();
		let desc = $("#item_desc").val();
		let data = CKEDITOR.instances.itemContent.getData();

		let formData = new FormData();

		formData.append("process", "insertItem");
		formData.append("file", files);
		formData.append("title", title);
		formData.append("desc", desc);
		formData.append("data", data);

		if ($('#item_featured').get(0).files.length === 0) { showAlert("error", "Please insert featured image.", 2500); }
		if (data.length <= 7 || title == "" || desc == "") { modalError = true; }
		
		if (modalError)
		{
			showAlert("error", "Please fill up all fields.", 2500);
			return true;
		}
		else
		{
			$.ajax(
			{
				url: "process.php",
				type: "POST",
				dataType: 'script',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(response)
				{
					if (response == "true")
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully inserted new item.", 2500);
					}
					else if (response == "false")
					{
						showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
					}
				}
			});
		}
	});
	$("#save_item").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let id = $(this).attr("data-item-id");
		let files = $("#edit_port_featured").prop("files")[0];
		let title = $("#edit_port_title").val();
		let desc = $("#edit_port_desc").val();
		let data = CKEDITOR.instances.editPortContent.getData();

		let formData = new FormData();

		formData.append("process", "updateItem");
		formData.append("id", id);
		formData.append("file", files);
		formData.append("title", title);
		formData.append("desc", desc);
		formData.append("data", data);

		if (data.length <= 7 || title == "" || desc == "") { modalError = true; }
		
		if (modalError)
		{
			showAlert("error", "Please fill up all fields.", 2500);
			return true;
		}
		else
		{
			$.ajax(
			{
				url: "process.php",
				type: "POST",
				dataType: 'script',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(response)
				{
					if (response == "true")
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully updated existing item.", 2500);
					}
					else if (response == "false")
					{
						showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
					}
				}
			});
		}
	});
	$("#delete_item").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let id = $(this).attr("data-item-id");

		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "deleteItem",
				id
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(function()
					{
						document.location.href = "port-item";
					}, 2500);
					showAlert("success", "You have successfully deleted selected item with ID: "+id, 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		});
	});
	$(".modal-load").delegate("#btn_insert_testimonial", "click", function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let text = $("#testimonial_text").val();
		let name = $("#testimonial_user").val();
		let title = $("#testimonial_title").val();

		if (text == "" || name == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "insertTestimonial",
				text, name, title
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully inserted new testimonial.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("body").delegate("#delete_testimonial", "click", function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let id = $(this).attr("data-testimonial");

		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "deleteTestimonial",
				id
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully deleted testimonial with ID: "+id, 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		});
	});
	$(".modal-load").delegate("#btn_edit_testimonial", "click", function(e)
	{
		e.preventDefault();
		let modalError = false;

		let id = $(this).attr("data-testimonial");
		let text = $("#edit_testimonial_text").val();
		let name = $("#edit_testimonial_user").val();
		let title = $("#edit_testimonial_title").val();

		if (text == "" || name == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "editTestimonial",
				id, text, name, title
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully updated testimonial with ID: "+id, 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$(".modal-load").delegate("#btn_insert_category", "click", function(e)
	{
		e.preventDefault();
		let modalError = false;

		let category = $("#category_name").val();

		if (category == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "addCategory",
				category
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully added new category.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("#update_home").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let files = $("#edit_home5").prop("files")[0];
		let edit_home1 = $("#edit_home1").val();
		let edit_home2 = $("#edit_home2").val();
		let edit_home3 = $("#edit_home3").val();
		let edit_home4 = $("#edit_home4").val();
		let edit_home6 = $("#edit_home6").val();
		let edit_home7 = $("#edit_home7").val();
		let edit_home8 = $("#edit_home8").val();
		let edit_home9 = $("#edit_home9").val();
		let edit_home10 = $("#edit_home10").val();
		let edit_home11 = $("#edit_home11").val();
		let edit_home12 = $("#edit_home12").val();
		let edit_home13 = $("#edit_home13").val();
		let edit_home14 = $("#edit_home14").val();
		let edit_home15 = $("#edit_home15").val();
		let edit_home16 = $("#edit_home16").val();

		let formData = new FormData();

		formData.append("process", "updateHome");
		formData.append("file", files);
		formData.append("edit_home1", edit_home1);
		formData.append("edit_home2", edit_home2);
		formData.append("edit_home3", edit_home3);
		formData.append("edit_home4", edit_home4);
		formData.append("edit_home6", edit_home6);
		formData.append("edit_home7", edit_home7);
		formData.append("edit_home8", edit_home8);
		formData.append("edit_home9", edit_home9);
		formData.append("edit_home10", edit_home10);
		formData.append("edit_home11", edit_home11);
		formData.append("edit_home12", edit_home12);
		formData.append("edit_home13", edit_home13);
		formData.append("edit_home14", edit_home14);
		formData.append("edit_home15", edit_home15);
		formData.append("edit_home16", edit_home16);
		
		if (edit_home1 == "" || edit_home2 == "" || edit_home3 == "" || edit_home4 == "" || edit_home6 == "" || edit_home7 == "" || edit_home8 == "" 
			|| edit_home9 == "" || edit_home10 == "" || edit_home11 == "" || edit_home12 == "" || edit_home13 == "" || edit_home14 == "" 
			|| edit_home15 == "" || edit_home16 == "") { modalError = true; }
		
		if (modalError)
		{
			showAlert("error", "Please fill up all fields.", 2500);
			return true;
		}
		else
		{
			$.ajax(
			{
				url: "process.php",
				type: "POST",
				dataType: 'script',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(response)
				{
					if (response == "true")
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully updated Home page.", 2500);
					}
					else if (response == "false")
					{
						showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
					}
				}
			});
		}
	});
	$("#update_about").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let edit_about1 = $("#edit_about1").val();
		let edit_about2 = $("#edit_about2").val();
		let edit_about3 = $("#edit_about3").val();
		let edit_about5 = $("#edit_about5").val();
		let edit_about6 = $("#edit_about6").val();
		let edit_about7 = $("#edit_about7").val();
		let edit_about8 = $("#edit_about8").val();
		let edit_about10 = $("#edit_about10").val();
		let edit_about11 = $("#edit_about11").val();

		let formData = new FormData();

		formData.append("process", "updateAbout");
		formData.append("edit_about1", edit_about1);
		formData.append("edit_about2", edit_about2);
		formData.append("edit_about3", edit_about3);
		formData.append("edit_about5", edit_about5);
		formData.append("edit_about6", edit_about6);
		formData.append("edit_about7", edit_about7);
		formData.append("edit_about8", edit_about8);
		formData.append("edit_about10", edit_about10);
		formData.append("edit_about11", edit_about11);
		
		if (edit_about1 == "" || edit_about2 == "" || edit_about3 == "" || edit_about5 == "" || edit_about6 == "" || edit_about7 == "" 
			|| edit_about8 == "" || edit_about10 == "" || edit_about11 == "") { modalError = true; }
		
		if (modalError)
		{
			showAlert("error", "Please fill up all fields.", 2500);
			return true;
		}
		else
		{
			$.ajax(
			{
				url: "process.php",
				type: "POST",
				dataType: 'script',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(response)
				{
					if (response == "true")
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully updated About page.", 2500);
					}
					else if (response == "false")
					{
						showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
					}
				}
			});
		}
	});
	$("#edit_img4").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let files = $("#edit_about4").prop("files")[0];

		let formData = new FormData();

		formData.append("process", "updateAboutImg1");
		formData.append("file", files);

		if ($('#edit_about4').get(0).files.length === 0) { showAlert("error", "Please insert featured image.", 2500); }

		$.ajax(
		{
			url: "process.php",
			type: "POST",
			dataType: 'script',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			success: function(response)
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully uploaded new image.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		});
	});
	$("#edit_img9").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let files = $("#edit_about9").prop("files")[0];

		let formData = new FormData();

		formData.append("process", "updateAboutImg2");
		formData.append("file", files);

		if ($('#edit_about9').get(0).files.length === 0) { showAlert("error", "Please insert featured image.", 2500); }
		
		$.ajax(
		{
			url: "process.php",
			type: "POST",
			dataType: 'script',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			success: function(response)
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully uploaded new image.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		});
	});
	$(".modal-load").delegate("#btn_add_member", "click", function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let files = $("#member_avatar").prop("files")[0];
		let member_name = $("#member_name").val();
		let member_title = $("#member_title").val();

		let formData = new FormData();

		formData.append("process", "insertMember");
		formData.append("file", files);
		formData.append("member_name", member_name);
		formData.append("member_title", member_title);
		
		if ($('#member_avatar').get(0).files.length === 0) { showAlert("error", "Please insert avatar.", 2500); modalError = true; }
		if (member_name == "" || member_title == "") { modalError = true; }
		
		if (modalError)
		{
			showAlert("error", "Please fill up all fields.", 2500);
			return true;
		}
		else
		{
			$.ajax(
			{
				url: "process.php",
				type: "POST",
				dataType: 'script',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(response)
				{
					if (response == "true")
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully added new team member", 2500);
					}
					else if (response == "false")
					{
						showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
					}
				}
			});
		}
	});
	$(".modal-load").delegate("#btn_edit_member", "click", function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let member_id = $(this).attr("data-member");

		let files = $("#edit_member_avatar").prop("files")[0];
		let edit_member_name = $("#edit_member_name").val();
		let edit_member_title = $("#edit_member_title").val();

		let formData = new FormData();

		formData.append("process", "updateMember");
		formData.append("file", files);
		formData.append("member_id", member_id);
		formData.append("edit_member_name", edit_member_name);
		formData.append("edit_member_title", edit_member_title);
		
		if (edit_member_name == "" || edit_member_title == "") { modalError = true; }
		
		if (modalError)
		{
			showAlert("error", "Please fill up all fields.", 2500);
			return true;
		}
		else
		{
			$.ajax(
			{
				url: "process.php",
				type: "POST",
				dataType: 'script',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function(response)
				{
					if (response == "true")
					{
						setTimeout(refreshPage, 2500);
						showAlert("success", "You have successfully updated current team member.", 2500);
					}
					else if (response == "false")
					{
						showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
					}
				}
			});
		}
	});
	$(".modal-load").delegate("#btn_delete_member", "click", function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let id = $(this).attr("data-member");

		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "deleteMember",
				id
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully delete selected member.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		});
	});
	$("#update_pricing").click(function(e)
	{
		e.preventDefault();
		let modalError = false;

		let edit_pricing1 = $("#edit_pricing1").val();
		let edit_pricing2 = $("#edit_pricing2").val();

		if (edit_pricing1 == "" || edit_pricing2 == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "updatePricing",
				edit_pricing1, edit_pricing2
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully updated Pricing page.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("#update_blog").click(function(e)
	{
		e.preventDefault();
		let modalError = false;

		let edit_blog1 = $("#edit_blog1").val();
		let edit_blog2 = $("#edit_blog2").val();
		let edit_blog3 = $("#edit_blog3").val();

		if (edit_blog1 == "" || edit_blog2 == "" || edit_blog3 == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "updateBlog",
				edit_blog1, edit_blog2, edit_blog3
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully updated Blog page.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("#update_portfolio").click(function(e)
	{
		e.preventDefault();
		let modalError = false;

		let edit_portfolio1 = $("#edit_portfolio1").val();
		let edit_portfolio2 = $("#edit_portfolio2").val();
		let edit_portfolio3 = $("#edit_portfolio3").val();
		let edit_portfolio4 = $("#edit_portfolio4").val();

		if (edit_portfolio1 == "" || edit_portfolio2 == "" || edit_portfolio3 == "" || edit_portfolio4 == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "updatePortfolio",
				edit_portfolio1, edit_portfolio2, edit_portfolio3, edit_portfolio4
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully updated Portfolio page.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("#update_faq").click(function(e)
	{
		e.preventDefault();
		let modalError = false;

		let edit_faq1 = $("#edit_faq1").val();
		let edit_faq2 = $("#edit_faq2").val();
		let edit_faq3 = $("#edit_faq3").val();
		let edit_faq4 = $("#edit_faq4").val();
		let edit_faq5 = $("#edit_faq5").val();
		let edit_faq6 = $("#edit_faq6").val();

		if (edit_faq1 == "" || edit_faq2 == "" || edit_faq3 == "" || edit_faq4 == "" || edit_faq5 == "" || edit_faq6 == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "updateFAQ",
				edit_faq1, edit_faq2, edit_faq3, edit_faq4, edit_faq5, edit_faq6 
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully updated FAQ page.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("#add_faq").click(function(e)
	{
		e.preventDefault();
		let modalError = false;

		let faq_title = $("#faq_title").val();
		let faq_answer = $("#faq_answer").val();

		if (faq_title == "" || faq_answer == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "insertFAQ",
				faq_title, faq_answer
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully inserted new FAQ.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("button#delete_faq").click(function(e)
	{
		e.preventDefault();
		let modalError = false;
		
		let id = $(this).attr("data-faq");

		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "deleteFAQ",
				id
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(function()
					{
						document.location.href = "page?filter=faq";
					}, 2500);
					showAlert("success", "You have successfully deleted FAQ with ID: "+id, 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		});
	});

});	