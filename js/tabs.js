var NERD = NERD || {};

$(function($,APP){

  $(function(){
    APP.tabs.init();
  });
  
  APP.tabs = {
    init: function(){
      this.myTabs = new APP.tab($('.js-tab'),$('.js-panel'),'tabs-tab_isActive','panels-panel_isActive');
      this.myInnerTabs = new APP.tab($('.js-innerTab'),$('.js-innerPanel'),'tabs-tab_isActive','panels-panel_isActive');
      this.$button = $('.js-button');
      this.test();
    },
    test: function(){
      var self = this;
      this.$button.on('click',function(){
        self.myTabs.toggleActive(3);
      });
    }
  };
  
  APP.tab = (function(){
  
    var tabs = function($tabs,$panels,tabsActiveClass,panelsActiveClass){
      if($tabs !== 'object' && $panels !== 'object') {
        this.init($tabs,$panels,tabsActiveClass,panelsActiveClass);
      } else {
        return;
      }
    };
    
    tabs.prototype.init = function($tabs,$panels,tabsActiveClass,panelsActiveClass){
      this.isEnabled = false;
      this.$tabs = $tabs;
      this.$panels = $panels;
      if(tabsActiveClass === 'undefined'){
        this.tabsActiveClass = 'isActive';
      } else {
        this.tabsActiveClass = tabsActiveClass;
      }
      if(panelsActiveClass === 'undefined'){
        this.panelsActiveClass = 'isActive';
      } else {
        this.panelsActiveClass = panelsActiveClass;
      }      
      this.setupHandlers()
          .enable();
    };
    
    tabs.prototype.setupHandlers = function(){
      this.onClickHandler = $.proxy(this.onClick,this);
      return this;
    };
    
    tabs.prototype.enable = function(){
      if(this.isEnabled === true) {
        return;
      }
      this.isEnabled = true;
      this.$tabs.on('click',this.onClickHandler);
      return this;
    };
    
    tabs.prototype.onClick = function(event){
      var target = $(event.currentTarget);
      var thePanel = target.data('tab');
      this.toggleActive(thePanel);
    };
    
    tabs.prototype.toggleActive = function(thePanel){
      this.$tabs.removeClass(this.tabsActiveClass);
      this.$tabs.filter('[data-tab="'+thePanel+'"]')
                .addClass(this.tabsActiveClass);
      this.$panels.removeClass(this.panelsActiveClass);
      this.$panels.filter('[data-panel="'+thePanel+'"]')
                .addClass(this.panelsActiveClass);      
    };
    
    return tabs;
    
  }());

}(jQuery,NERD));