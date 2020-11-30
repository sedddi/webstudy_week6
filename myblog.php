<?php
session_start();
$conn=mysqli_connect("localhost","root","ksyiris00","nonwebsite");
mysqli_select_db($conn,'nonwebsite');
$user=$_SESSION["id"];
 ?>

<!doctype html>
<head>
<meta charset="UTF-8">
<title>My Blog</title>
<link rel="stylesheet" type="text/css" href="/N0named_web/style.css" />
</head>
<body>
<div id="board_area">

<?php echo "<h1> $user 의 블로그</h1>";
// echo $_COOKIE['id']?>

  <h4>글 목록</h4>
  <form method = GET action=myblog.php>
    글 검색 : <input type="text" name="search">
    <input type=submit>
  </form>
  <?php
  $search = $_GET["search"];
  if(isset($search)){

    $query="select * from nonboard where title like '%".$search."%';";
    $result=mysqli_query($conn, $query)or die("query error");
    while($row=mysqli_fetch_array($result)){
      echo "=================================================================";
      echo "<li>글 번호 : {$row['num']}</li>";
      echo "<li>글쓴이 : {$row['id']}</li>";
      echo "<li>비밀번호 : {$row['pw']}</li>";
      echo "<li>작성일 : {$row['date']}</li>";
      echo "<li>제목 : {$row['title']}</li>";
      echo "<li>내용 : {$row['content']}</li>";

    // mysql_select_db("information_schema",$s);
    // $result=mysql_query('select substr((select table_name from tables limit 0,1),1,33)');
    // $result=mysqli_fetch_array($result);
    //     print $result[0];
    //     print $result[1];
    }
  }
   ?>
  <FORM action="nonwrite.php" method="post" name="글 작성 페이지">
    <input type="button" value="WRITE" onclick="location.href='nonwrite.php'" style="float:right;">
    </FORM><br>
    <table class="list-table">
      <thead>
          <tr>
              <th width="70">번호</th>
                <th width="400">제목</th>
                <th width="200">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
        $query="select * from nonboard where id='$user';";
        $result=mysqli_query($conn, $query) or die("query error");
        while($row=mysqli_fetch_array($result)){?>
          <tr>
          <td><?php echo $row['num']; ?></td>
          <td><a href='view.php?num=<?php echo $row['num']?>'><?php echo $row['title'];?></a></td>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['date']; ?></td>
          <td><?php echo $row['hit']; ?></td>
        </tr><?php
      }?>
    </table>
  </div>
</body>
</html>
