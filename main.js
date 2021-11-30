setInterval("checkconnection()", 6000);

var timer = null;
var modalError = false;

function checkconnection() 
{
    let status = navigator.onLine;
    if (!status) {
		showAlert("error", "Seem like you've lost your internet connection!", 2500);
    }
}

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
	$("#modalLogin").click(function(e)
	{
		e.preventDefault();
		$(this).prop("disabled", true);

		$(".modal-load").load("elements/modals.php", { modal: "modalLogin" }, function() 
		{ 
			$(".modal-load").slideDown("fast", function() 
			{ 
				$(".modal-load").css("display", "flex");
				$("body").addClass("modal-open");
				$(".modal").slideDown("fast");
				$("#modalLogin").prop("disabled", false);
			}); 
		});
	});
	$("#modalRegister").click(function(e)
	{
		e.preventDefault();
		$(this).prop("disabled", true);

		$(".modal-load").load("elements/modals.php", { modal: "modalRegister" }, function() 
		{ 
			$(".modal-load").slideDown("fast", function() 
			{ 
				$(".modal-load").css("display", "flex");
				$("body").addClass("modal-open");
				$(".modal").slideDown("fast");
				$("#modalRegister").prop("disabled", false);
			}); 
		});
	});
	$("#delete_account").click(function(e)
	{
		e.preventDefault();
		$(this).prop("disabled", true);

		let account = $(this).attr("data-account");

		$(".modal-load").load("elements/modals.php", { modal: "modalDeleteAcc", account: account }, function() 
		{ 
			$(".modal-load").slideDown("fast", function() 
			{ 
				$(".modal-load").css("display", "flex");
				$("body").addClass("modal-open");
				$(".modal").slideDown("fast");
				$("#delete_account").prop("disabled", false);
			}); 
		});
	});
	$(".modal-load").delegate("#btnSignIn", "click", function(e)
	{
		e.preventDefault();
		var modalError = false;

		var email = $("#email").val();
		var password = $("#password").val();

		if ($("#rememberMe").is(":checked"))
		{
			var rememberMe = true;
		}
		else { var rememberMe = false; }

		if (email == "" || password == "") { modalError = true;  }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "login",
				email, password, rememberMe
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have been successfully logged in, please wait..", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "You have entered incorrect EMail or Password! Please try again..", 3500);
				}
				else if (response == "approved")
				{
					showAlert("error", "Your account is still under review! Please try again later...", 3500);
				}
			}
		}); }
	});
	$(".modal-load").delegate("#btnSignUp", "click", function(e)
	{
		e.preventDefault();
		var modalError = false;

		var user_email = $("#user_email").val();
		var user_pass = $("#user_pass").val();
		var user_name = $("#user_name").val();
		var user_phone = $("#user_phone").val();
		var user_bday = $("#user_bday").val();

		if ($("#user_gender").is(":checked"))
		{
			gender = "1";
		}
		else { gender = "0"; }

		if (user_email == "" || user_pass == "" || user_name == "" || user_phone == "" || user_bday == "") { modalError = true;  }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "register",
				user_email, user_pass, user_name, gender, user_phone, user_bday
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully signed up, please wait..", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
				else if (response == "valid-email")
				{
					showAlert("error", "Please enter valid EMail address.", 3500);
				}
				else if (response == "exists")
				{
					showAlert("error", "This EMail address already exists in our database.", 3500);
				}
			}
		}); }
	});
	$("#button_newsletter").click(function(e)
	{
		e.preventDefault();
		var modalError = false;
		
		var email_newsletter = $("#email_newsletter").val();

		if (email_newsletter == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please enter your EMail address.", 4000); }

		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "newsletter",
				email_newsletter
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully signed in for our newsletter.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
				else if (response == "valid-email")
				{
					showAlert("error", "Please enter valid EMail address.", 3500);
				}
				else if (response == "exists")
				{
					showAlert("error", "This EMail address already exists in our database.", 3500);
				}
			}
		});
	});
	$(".modal-load").delegate("#btn_delete_account", "click", function(e)
	{
		e.preventDefault();
		var modalError = false;

		let account = $(this).attr("data-acc-id");

		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "deleteAccount",
				account
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully deactivated your account..", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		});
	});
	$("#update_password").click(function(e)
	{
		e.preventDefault();
		var modalError = false;
		
		let account = $(this).attr("data-account");
		let old_pass = $("#old_password").val();
		let new_pass = $("#new_password").val();
		let cf_pass = $("#cf_password").val();

		if (old_pass == "" || new_pass == "" || cf_pass == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else if (new_pass != cf_pass) { showAlert("error", "Password does not match with confirm password.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "changePassword",
				account, old_pass, new_pass
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully changed your password, please sign in again.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
				else if (response == "old-password")
				{
					showAlert("error", "Your current password is incorrect.", 3500);
				}
			}
		}); }
	});
	$("#update_profile").click(function(e)
	{
		e.preventDefault();
		var modalError = false;
		
		let account = $(this).attr("data-profile");
		let full_name = $("#full_name").val();
		let user_phone = $("#user_phone").val();
		

		if (full_name == "" || user_phone == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "updateProfile",
				account, full_name, user_phone
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "You have successfully updated your profile informations.", 2500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	$("#submitButton").click(function(e)
	{
		e.preventDefault();
		var modalError = false;
		
		let name = $("#name").val();
		let email = $("#email").val();
		let phone = $("#phone").val();
		let message = $("#message").val();
		

		if (name == "" || email == "" || phone == "" || message == "") { modalError = true; }

		if (modalError) { showAlert("error", "Please fill up all fields.", 4000); }
		else {
		$.ajax({
			method: "POST",
			url: "process.php",
			data:
			{
				process: "sendEmail",
				name, email, phone, message
			},
			success: function(response) 
			{
				if (response == "true")
				{
					setTimeout(refreshPage, 2500);
					showAlert("success", "Your message was successfully sent, please wait for answer.", 2500);
				}
				else if (response == "valid-email")
				{
					showAlert("error", "Please enter valid EMail address.", 3500);
				}
				else if (response == "false")
				{
					showAlert("error", "There was an error! Please try again or contact our Support Team.", 3500);
				}
			}
		}); }
	});
	

});	