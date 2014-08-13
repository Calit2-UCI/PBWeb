<?php include('_header.php'); ?>
<link rel="stylesheet"  href="stylesheets/tabs.css">

<div class="container">
  <h1 class="intro">Object Oriented Tabs</h1>
  <div class="btnWrap">
    <button class="btn js-button">Click me!</button>
  </div>
  <ul class="tabs">
    <li class="tabs-tab tabs-tab_1 tabs-tab_isActive js-tab" data-tab="1">One</li>
    <li class="tabs-tab tabs-tab_2 js-tab" data-tab="2">Two</li>
    <li class="tabs-tab tabs-tab_3 js-tab" data-tab="3">I have something in me</li>
  </ul>
  <ul class="panels">
    <li class="panels-panel panels-panel_isActive js-panel" data-panel="1">
      <div class="panels-panel-content">
        <div class="media">
          <div class="media-img">
            <img src="http://baconmockup.com/300/200" alt="Mmmmm" />
          </div>
          <div class="media-bd">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim placeat totam mollitia voluptate accusamus autem similique commodi culpa neque obcaecati. Iusto tempora quod quae repellat fugiat laudantium ratione id blanditiis voluptatibus quas. Quia dignissimos odio quaerat unde doloremque dolor aspernatur.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim placeat totam mollitia voluptate accusamus autem similique commodi culpa neque obcaecati. Iusto tempora quod quae repellat fugiat laudantium ratione id blanditiis voluptatibus quas.</p>
          </div>
        </div>
      </div>
    </li>
    <li class="panels-panel js-panel" data-panel="2">
      <div class="panels-panel-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim placeat totam mollitia voluptate accusamus autem similique commodi culpa neque obcaecati. Iusto tempora quod quae repellat fugiat laudantium ratione id blanditiis voluptatibus quas. Quia dignissimos odio quaerat unde doloremque dolor aspernatur.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque porro optio officia quo saepe repellendus accusantium aliquam harum! Quaerat maiores blanditiis neque quo amet voluptatibus itaque quod quas repellendus. Laborum totam molestiae quisquam earum dolore mollitia deserunt? Repudiandae fuga quaerat dolor maxime laudantium accusantium doloremque voluptatum odit qui fugiat aliquam facilis nemo quasi labore porro laborum natus a ratione aperiam excepturi corporis ducimus non dolorum dicta sapiente rem labore aliquid voluptatibus sit cumque accusantium architecto dolore totam repellendus. Dignissimos distinctio sit ab quasi culpa nulla dolorum error.</p>
      </div>      
    </li>
    <li class="panels-panel js-panel" data-panel="3">
      <div class="panels-panel-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim placeat totam mollitia voluptate accusamus autem similique commodi culpa neque obcaecati. Iusto tempora quod quae repellat fugiat laudantium ratione id blanditiis voluptatibus quas. Quia dignissimos odio quaerat unde doloremque dolor aspernatur.</p>
        <ul class="tabs">
          <li class="tabs-tab tabs-tab_1 tabs-tab_isActive js-innerTab" data-tab="1">One</li>
          <li class="tabs-tab tabs-tab_2 js-innerTab" data-tab="2">two</li>
        </ul>
        <ul class="panels">
          <li class="panels-panel panels-panel_isActive js-innerPanel" data-panel="1">
            <div class="panels-panel-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe beatae non dolore accusantium culpa molestiae reprehenderit adipisci deleniti ut aspernatur eveniet animi ea nobis recusandae velit voluptatum natus numquam a soluta commodi consectetur ipsa corporis voluptatibus! Ducimus aliquid esse facere vitae molestias veritatis illum sit voluptates dolore cupiditate ipsum porro.</p>
            </div>
          </li>
          <li class="panels-panel js-innerPanel" data-panel="2">
            <div class="panels-panel-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum sit voluptates dolore cupiditate ipsum porro.</p>
            </div>            
          </li>          
        </ul>
      </div>      
    </li>
  </ul>
</div>

<script src="js/jquery.js"></script>
<script src="js/tabs.js"></script>
<?php include('_footer.php'); ?>
