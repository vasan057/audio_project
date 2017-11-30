function getS3PreSignedUrl(callback)
{
	$.ajax({
		url: base_url+'/coach/getS3PreSignedUrl',
		type: 'POST',
		dataType: 'json',
		data: {'_token':csrf_token},
	})
	.done(function(data)
	{
		result =  data;
		if(typeof callback === "function") callback(result);
	})
	.fail(function()
	{
		//console.log("error");
	})
	.always(function()
	{
		//console.log("complete");
	});
}