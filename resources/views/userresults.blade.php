<script type="text/template" data-grid="main" data-template="results">

	<% _.each(results, function(r) { %>

		<tr>

			<td><%= r.email %></td>
			<td><%= r.first_name %></td>
			<td><%= r.last_name %></td>
			<td><%= r.address %></td>
			<td><%= r.city %></td>
			<td><%= r.postcode %></td>
			<td><%= r.company %></td>
			<td><%= r.phone %></td>
		</tr>

	<% }); %>

</script>
