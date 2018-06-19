
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Travel Solution</title>

<!-- Bootstrap core CSS -->

<!-- Custom styles for this template 
<link href="css/business-frontpage.css" rel="stylesheet">-->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="icon" href="asset/images/TSFavicon.png" type="image/gif" sizes="16x16">

<style>


@import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);
/* written by riliwan balogun http://www.facebook.com/riliwan.rabo*/
.board{
width: 75%;
color: white;
margin: 60px auto;
padding-bottom:5%;
height: auto;
background: #fff;
/*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/
}
.board .nav-tabs {
    position: relative;
    /* border-bottom: 0; */
    /* width: 80%; 
    margin: 0px auto; */
    margin-bottom: 0;
    box-sizing: border-box;

}

.board > div.board-inner{
    /*background: #fafafa url(http://subtlepatterns.com/patterns/geometry2.png); */
	background-color:rgba(0,0,0,0.50);
    background-size: 30%;
}

p.narrow{
    width: 60%;
    margin: 10px auto;
}

.liner{
    height: 2px;
    background: #ddd;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    /* background-color: #ffffff; */
    border-bottom-color: transparent;
}

span.round-tabs{
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: white;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 35px;
}

span.round-tabs.one{
    color: rgb(34, 194, 34);
}

li.active span.round-tabs.one{
    background: #fff !important;
    color: rgb(34, 194, 34);
}

span.round-tabs.two{
    color: #febe29;
}

li.active span.round-tabs.two{
    background: #fff !important;
    color: #febe29;
}

span.round-tabs.three{
    color: #3e5e9a;
}

li.active span.round-tabs.three{
    background: #fff !important;
    color: #3e5e9a;
}

span.round-tabs.four{
    color: #f1685e;
}

li.active span.round-tabs.four{
    background: #fff !important;
    color: #f1685e;
}

span.round-tabs.five{
    color: #000;
}

li.active span.round-tabs.five{
    background: #fff !important;
    color: #999;
}

.nav-tabs > li.active > a span.round-tabs{
    background: #fff;
}
.nav-tabs > li {
    width: 20%;
}
.nav-tabs > li:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:0;
    margin: 0 auto;
    border: 5px solid transparent;
    transition:0.1s ease-in-out;
    
}
.nav-tabs > li.active:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    
}
.nav-tabs > li a{
   width: 70px;
   height: 70px;
   margin: 20px auto;
   border-radius: 100%;
   padding: 0;
}

.nav-tabs > li a:hover{
    background: transparent;
}

.tab-content{
}
.tab-pane{
   position: relative;
padding-top: 50px;
}
.tab-content .head{
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 25px;
    text-transform: uppercase;
    padding-bottom: 10px;
}
.btn-outline-rounded{
    padding: 10px 40px;
    margin: 20px 0;
    border: 2px solid transparent;
    border-radius: 25px;
}

.btn.green{
    background-color:#5cb85c;
    /*border: 2px solid #5cb85c;*/
    color: #ffffff;
}



@media( max-width : 585px ){
    
    .board {
width: 90%;
height:auto !important;
}
    span.round-tabs {
        font-size:16px;
width: 50px;
height: 50px;
line-height: 50px;
    }
    .tab-content .head{
        font-size:20px;
        }
    .nav-tabs > li a {
width: 50px;
height: 50px;
line-height:50px;
}

.nav-tabs > li img {
width: 40px;
height: 40px;
line-height:50px;
}

.nav-tabs > li.active:after {
content: " ";
position: absolute;
left: 35%;
}

.btn-outline-rounded {
    padding:12px 20px;
    }
}

.bgimg {
   background: url('asset/images/headerBackground3.jpg') center center no-repeat scroll;
}

</style>
