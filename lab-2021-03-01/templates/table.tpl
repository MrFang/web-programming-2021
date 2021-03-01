<table class="table table-bordered m-2">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Position</th>
        <th></th>
        <th></th>
    </tr>
    { foreach from=$allUsers item=user }
      <tr>
          <td>{ $user.id }</td>
          <td>{ $user.name }</td>
          <td>{ $user.position }</td>
          <td><a href="{ $URL }?edit=&id={ $user.id }">Edit<a></td>
          <td><a href="{ $URL }?delete=&id={ $user.id }">Delete<a></td>
      </tr>
    { /foreach }
</table>