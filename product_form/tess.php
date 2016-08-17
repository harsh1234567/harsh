<?php if (isset($_POST["submit"]))
    {foreach ($_POST['searchid'] as $searchid) {
        $data1 = $searchid;
       echo $data1;
       // mysql_query("INSERT INTO php_test (name) VALUES ('$data1')") or die(mysql_error());
    }
}
?>
<form   method="post" >
<table>
<tr>
    <td>
        <input type="text" name="searchid[]" id="searchid" placeholder="Data 1" ><br />
        <input type="text" name="searchid[]" id="searchid" placeholder="Data 2" ><br />
        <input type="text" name="searchid[]" id="searchid" placeholder="Data 3" ><br />
        <input type="text" name="searchid[]" id="searchid" placeholder="Data 4" ><br />
    </td>
</tr>
<tr>
<td><input type="submit" name="submit" id="submit" value="submit" /></td>
</tr>

</table>    
</form>
