var work = {
    models: {},
    views: {}
};
$.ajaxSetup({
    data: {
        ajax: !0
    }
}),
function (e) {
    e.fn.extend({
        translateY: function (t) {
            return arguments.length ? e(this)
                .translate3d(0, t) : e(this)
                .translate3d()
                .y
        },
        translateX: function (t) {
            return arguments.length ? e(this)
                .translate3d(t, 0) : e(this)
                .translate3d()
                .x
        },
        translate3d: function (t, n) {
            var r = e(this)
                .get(0);
            if(!(arguments.length >= 2)) {
                var i = getComputedStyle(r)
                    .webkitTransform;
                return i === "none" ? {
                    x: 0,
                    y: 0
                } : {
                    x: +i.substring(19, i.indexOf(",", 19)),
                    y: +i.substring(i.lastIndexOf(",") + 2, i.indexOf(")", 19))
                }
            }
            r.style.webkitTransform = "translate3d(" + t + "px, " + n + "px,0)"
        }
    })
}(jQuery),
function (e) {
    var t = {
        property: "opacity",
        duration: 0,
        delay: 0,
        start: 0,
        end: 1,
        easing: "linear",
        percent: !1
    };
    e.fn.parallax = function (n) {
        return n = e.extend({}, t, n), e(this)
            .each(function () {
                var t = e(this),
                    r = e(window),
                    i = r.scrollTop(),
                    s = Math.min(1, Math.max(0, i - n.delay) / n.duration),
                    o = e.easing[n.easing](s, s, 0, 1, 1),
                    u = n.start + o * (n.end - n.start);
                n.percent && (u += "%"), t.css(n.property, u), n.callback && n.callback(o)
            })
    }
}(jQuery),
function (e) {
    var t = "last-on-line";
    e.fn.lastOnLine = function (n) {
        e(this)
            .removeClass(t);
        var r = 0;
        return e(this)
            .each(function () {
                var n = e(this)
                    .position()
                    .top;
                n > r && (e(this)
                    .prev()
                    .addClass(t), r = n)
            }), e(this)
    }
}(jQuery), work.Router = Backbone.Router.extend({
    initialUpdate: !0,
    routes: {
        "project/:project": "project",
        "": "home"
    },
    initialize: function (e) {
        _.extend(this, e);
        if(this.oldie) return;
        this.state.on("change", this.updateUrl, this)
    },
    route: function (e, t, n) {
        Backbone.Router.prototype.route.call(this, e, t, this.oldie ? n : function () {
            this.state.updateQueryParams(_.last(arguments)), n.apply(this, arguments)
        })
    },
    updateUrl: function (e) {
        var t = this.state.url(!1),
            n = e.hasChanged("project") || e.hasChanged("section"),
            r = this.initialUpdate || !n;
        this.navigate(this.state.url(!0), {
            replace: r
        })
    },
    home: function () {
        this.state.set({
            section: "home"
        })
    },
    project: function (e) {
        this.state.set({
            section: "project",
            project: e
        })
    }
}), work.models.State = Backbone.Model.extend({
    queryParams: ["category", "search", "projects"],
    defaults: {
        section: null,
        project: null,
        projects: !1,
        category: "all",
        search: null
    },
    getQueryParams: function () {
        var e = _.reduce(this.queryParams, function (e, t) {
            var n = this.get(t);
            return this.defaults[t] !== n && (e[t] = n), e
        }, {}, this);
        return $.param(e)
    },
    updateQueryParams: function (e) {
        e = e || {}, e = _.defaults(e, this.defaults), e = _.pick(e, this.queryParams), _.each(e, function (t, n) {
            t === "true" && (e[n] = !0), t === "false" && (e[n] = !1)
        }, this), this.set(e, {
            silent: !0
        })
    },
    url: function (e) {
        var t = this.get("section"),
            n = "/";
        t === "project" && (n = "/project/" + this.get("project"));
        if(e && this.get("projects") === !0) {
            var r = this.getQueryParams();
            n += r ? "?" + r : ""
        }
        return n
    },
    setProjectFromUrl: function (e, t) {
        this.set("projects", !1);
        var n = window.location.protocol + "//" + window.location.host,
            r = e.replace("/project/", "")
                .replace(n, "");
        this.set({
            section: "project",
            project: r
        })
    }
}), work.views.Navigation = Backbone.View.extend({
    events: {
        "click .home": "homeClick",
        "click .toggle-projects": "toggleProjectsClick",
        "click .projects a": "projectClick",
        "click .categories a": "categoryClick",
        "click .close, .overlay": "closeProjects",
        "keydown .search input": "inputKeyDown",
        "keyup .search input": "inputKeyUp",
        "change .search input": "inputChange",
        "submit .search": "inputSubmit",
        "click .search.filled .clear": "clear"
    },
	
	
    initialize: function (e) {
        _.extend(this, e), this.startTime = +(new Date), this.$search = this.$(".search"), this.$searchInput = this.$(".search input"), this.$categories = this.$(".categories"), this.$categoryItems = this.$(".categories li"), this.$overlay = this.$(".overlay"), this.$projectsBar = this.$(".projects-bar"), this.$projectsContainer = this.$(".projects"), this.$projects = this.$(".projects .project-item"), this.$projectsList = this.$(".projects ul"), this.$projectsScrollContainer = this.$(".projects .scroll"), this.$projectsScrollBar = this.$(".projects .scroll .scroll-bar"), this.$projectsScrollThumb = this.$(".projects .scroll .scroll-thumb"), this.$searchInput.labelize(), _.each(this.$projects, function (e) {
            var t = $(e);
            t.data("categories", t.attr("data-categories")
                .split(",")), t.data("searchText", t.text())
        }), $(window)
            .on("resize", $.proxy(this.updateLayout, this)), $(window)
            .on("resize", _.debounce($.proxy(this.updateLayout, this), 400)), $(window)
            .on("resize", $.proxy(this.updateScrollBar, this)), this.$projectsScrollContainer.on("scroll", $.proxy(this.updateScrollBar, this)), this.$projectsScrollThumb.on("mousedown", $.proxy(this.scrollDragStart, this)), this.state.on("change:project", this.projectChange, this), this.state.on("change:projects", this.projectsChange, this), this.state.on("change:category", this.categoryChange, this), this.state.on("change:search", this.searchChange, this), this.state.on("change:section", this.sectionChange, this), this.vent.on("showLogo", this.showLogo, this), this.vent.on("hideLogo", this.hideLogo, this), this.vent.on("logoNavigation", this.updateLogoNavigation, this), this.updateLayout(), this.renderCategories(), this.filterProjects(), this.updateScrollBar()
    },
    getPreviousProject: function () {
        var e = this.getActiveProject()
            .prev(".visible");
        return e.length ? e : !1
    },
    getNextProject: function () {
        var e = this.getActiveProject()
            .next(".visible");
        return e.length ? e : !1
    },
    getActiveProject: function () {
        return this.$projects.filter(".active")
    },
    updateLogoNavigation: function (e) {
        this.$(".primary .home .action")
            .removeClass("top-active home-active")
            .addClass(e + "-active")
    },
    updateScrollBar: function () {
        var e = this.$projectsScrollContainer.outerHeight(),
            t = this.$projectsList.outerHeight(),
            n = this.$projectsScrollContainer.scrollTop() / t * 100,
            r = Math.max(5, e / t * 100);
        this.$projectsScrollThumb.css({
            top: n + "%",
            height: r + "%"
        }), this.$projectsScrollBar.toggleClass("active", r < 100)
    },
    scrollDragStart: function (e) {
        e.preventDefault();
        var t = this.$projectsScrollContainer.outerHeight(),
            n = this.$projectsList.outerHeight(),
            r = e.clientY,
            i = this.$projectsScrollContainer.scrollTop();
        this.$projectsScrollThumb.addClass("scrolling");
        var s = function (e) {
            var s = (e.clientY - r) * (n / t) + i;
            this.$projectsScrollContainer.scrollTop(s)
        }, o = function () {
                $(document)
                    .off("mousemove", s), $(document)
                    .off("mouseup", o), this.$projectsScrollThumb.removeClass("scrolling")
            };
        $(document)
            .on("mousemove", $.proxy(s, this)), $(document)
            .on("mouseup", $.proxy(o, this))
    },
    homeClick: function (e) {
        e.preventDefault(), this.closeProjects(), this.state.set("section", "home")
    },
    toggleProjectsClick: function (e) {
        e.preventDefault(), this.state.set("projects", !this.state.get("projects"))
    },
    projectsChange: function (e, t) {
        var n = new Date - this.startTime < 200;
        n && this.$el.addClass("no-animation"), this.$el.toggleClass("open", t), $("body")
            .toggleClass("projects-open", t), this.updateScrollBar(), this.updateLayout(), n && _.delay(_.bind(this.$el.removeClass, this.$el), 10, "no-animation"), _gaq.push(["_trackEvent", "Projects bar", t ? "Open" : "Close"])
    },
    sectionChange: function (e, t) {
        t !== "project" && this.$projects.removeClass("active")
    },
    projectClick: function (e) {
        e.preventDefault(), this.state.setProjectFromUrl($(e.currentTarget)
            .attr("href"))
    },
    projectChange: function (e, t) {
        this.$projects.removeClass("active"), this.$projects.find('a[href="' + this.state.url() + '"]')
            .closest("li")
            .addClass("active")
    },
    categoryClick: function (e) {
        e.preventDefault(), this.state.set({
            search: null,
            category: $(e.currentTarget)
                .attr("data-id")
        }), _gaq.push(["_trackEvent", "Projects bar", "Filter category", $(e.currentTarget)
            .attr("data-id")]), this.$searchInput.blur()
    },
    closeProjects: function () {
        this.state.set("projects", !1)
    },
    categoryChange: function () {
        this.$projectsScrollContainer.scrollTop(0), this.renderCategories(), this.filterProjects()
    },
    renderCategories: function () {
        var e = this.state.get("category"),
            t = this.$categories.find("a[data-id=" + (e || "") + "]");
        t.parent()
            .addClass("selected")
            .siblings()
            .removeClass("selected")
    },
    inputKeyDown: function (e) {
        e.which === 27 && (this.state.set("search", null), this.$searchInput.val("")
            .blur(), this.updateClearButton())
    },
    inputKeyUp: function () {
        this.state.set({
            search: this.$searchInput.val(),
            category: "all"
        }, {
            silent: !0
        }), this.renderCategories(), this.filterProjects(), this.updateClearButton()
    },
    updateClearButton: function () {
        this.$search.toggleClass("filled", !_.isEmpty(this.$searchInput.val()))
    },
    inputChange: function () {
        var e = this.$searchInput.val();
        this.state.set({
            search: _.isEmpty(e) ? null : e,
            category: "all"
        })
    },
    inputSubmit: function (e) {
        e.preventDefault(), this.$searchInput.blur()
    },
    searchChange: function (e, t) {
        this.filterProjects(), this.$(".search input")
            .is(":focus") || (this.$searchInput.val(t)
                .blur(), this.updateClearButton()), t && _gaq.push(["_trackEvent", "Projects bar", "Search projects", t])
    },
    clear: function () {
        this.$search.removeClass("filled"), this.state.set("search", null), this.$searchInput.blur()
    },
    filterProjects: function () {
        var e = this.state.get("category"),
            t = this.state.get("search");
        if(t) {
            var n = 0;
            _.each(this.$projects, function (e) {
                var r = $(e),
                    i = (new RegExp("\\b" + t, "i"))
                        .test(r.data("searchText"));
                i && n++, r.toggleClass("visible", i)
            }), this.$projectsContainer.toggleClass("no-results", n === 0), this.$projectsContainer.find(".no-results .query")
                .text(t);
            return
        }
        this.$projectsContainer.removeClass("no-results"), _.each(this.$projects, function (t) {
            var n = $(t),
                r = e === "all",
                i = _.include(n.data("categories"), e);
            n.toggleClass("visible", r || i)
        }), this.updateScrollBar()
    },
    updateLayout: function () {
        var e;
        this.$overlay.width($(window)
            .width()), $(window)
            .width() >= 600 && (e = $(window)
                .height() - (this.$categories.position()
                    .top + this.$categories.outerHeight())), this.$projectsContainer.css({
                height: e ? e : ""
            }), this.$categoryItems.lastOnLine()
    }
}), work.views.Page = Backbone.View.extend({
    view: null,
    request: null,
    url: null,
    initialLoad: !0,
    replacedHash: Modernizr.history && window.location.hash,
    baseTitle: document.title,
    initialize: function (e) {
        _.extend(this, e), this.state = e.state, this.state.on("change:section change:project", this.pageChange, this)
    },
    pageChange: function (e) {
        if(this.url === this.state.url()) return;
        this.request && this.request.abort();
        var t = this.state.url(),
            n = this.cache(t),
            r = Modernizr.history,
            i = !_.include(["", "#"], window.location.hash),
            s = this.initialLoad && (r && !this.replacedHash || !r && !i);
        this.url = t, this.initialLoad = !1, this.showLoader(), this.view && this.view.destroy && this.view.destroy();
        if(s) {
            this.cache(t, this.$el.html()), this.showSection();
            return
        }
        n ? (this.setContent(n), this.showSection()) : this.load(t), $(window)
            .scrollTop(0)
    },
    load: function (e) {
        this.request = $.get(e), this.request.done(_.bind(function (t) {
            this.cache(e, t), this.setContent(t), this.showSection()
        }, this)), this.request.always(_.bind(function (e) {
            this.request = null
        }, this))
    },
    cache: function () {
        var e = {};
        return function (t, n) {
            return n && (e[t] = n), e[t]
        }
    }(),
    setContent: function (e) {
        this.$el.html(e)
    },
    showSection: function () {
        var e = this.state.get("section"),
            t = e.charAt(0)
                .toUpperCase() + e.slice(1),
            n = _.bind(this["show" + t] || function () {}, this);
        this.hideLoader(), n(this.$el.children()
            .first())
    },
    showHome: function (e) {
        this.view = new work.views.Home({
            el: e,
            state: this.state,
            vent: this.vent
        }), document.title = this.baseTitle
    },
    showProject: function (e) {
        this.view = new work.views.Project({
            el: e,
            state: this.state,
            vent: this.vent,
            navigation: this.navigation
        }), document.title = [this.view.$el.find(".info .name")
            .text(), this.baseTitle].join(" — ")
    },
    showLoader: function () {
        $("body")
            .addClass("page-loading")
    },
    hideLoader: function () {
        $("body")
            .removeClass("page-loading")
    }
}), work.views.Home = Backbone.View.extend({
    events: {
        "click .internal-navigation .to-top": "toTop",
        "click .internal-navigation ul a": "navigate",
        "click .about .inside-work": "navigate",
        "click .about .vacancies": "vacanciesClick",
        "click .featured.slideshow a": "slideshowClick",
        "click .how .services a": "serviceClick",
        "click .how .toggle-expanded": "toggleExpanded"
    },
    animation: {
        duration: 300,
        easing: "easeInOutExpo"
    },
    initialize: function (e) {
        _.extend(this, e), this.appState = e.state, this.vent.trigger("logoNavigation", "top"), this.$brand = this.$(".brand"), this.$sections = this.$(".featured, .section")
            .add("#contact"), this.$navigation = this.$(".internal-navigation"), this.$navigationItems = this.$navigation.find("li"), this.$fixedNavigation = this.$navigation.clone()
            .insertAfter(this.$navigation)
            .addClass("fixed closed"), this.viewState = new Backbone.Model({
                section: null,
                autoScrolling: !1
            }), this.viewState.on("change:section", this.sectionChange, this), this.about = new work.views.About({
                el: this.$(".about"),
                appState: this.appState
            });
        var t = new work.views.People({
            el: this.$(".people")
        }),
            n = new work.views.Clients({
                el: this.$(".clients")
            }),
            r = Modernizr.touch ? "TouchSlideshow" : "MouseSlideshow",
            i = new work.views[r]({
                el: this.$(".featured.slideshow"),
                spacing: 0
            }),
            s = new work.views[r]({
                el: this.$(".inside .slideshow")
            });
        $(window)
            .on("resize", $.proxy(_.debounce(this.$navigationItems.lastOnLine, 200), this.$navigationItems)), this.$navigationItems.lastOnLine(), $(window)
            .on("scroll", $.proxy(this.scroll, this)), $(window)
            .on("mousewheel", $.proxy(this.mousewheel, this)), $("#navigation .home")
            .on("click", $.proxy(this.homeClick, this)), !Modernizr.touch && this.initializePinning()
    },
    destroy: function () {
        this.about.destroy(), $(window)
            .off("scroll", $.proxy(this.scroll, this)), $(window)
            .off("mousewheel", $.proxy(this.mousewheel, this)), $("#navigation .home")
            .off("click", $.proxy(this.homeClick, this))
    },
    toTop: function (e) {
        e.preventDefault(), this.animateScroll(0)
    },
    toggleExpanded: function (e) {
        e.preventDefault(), this.$(".how")
            .toggleClass("expanded")
    },
    serviceClick: function (e) {
        e.preventDefault(), this.appState.set({
            projects: !0,
            category: $(e.currentTarget)
                .attr("data-id")
        })
    },
    initializePinning: function () {
        this.viewState.on("change:showFixedNavigation", this.showFixedNavigationChange, this), $(window)
            .on("scroll resize", $.proxy(this.updateFixedNavigation, this)), setTimeout(_.bind(function () {
                this.updateFixedNavigation()
            }, this), 100)
    },
    updateFixedNavigation: function () {
        var e = $(window)
            .scrollTop() >= this.$navigation.offset()
            .top;
        this.viewState.set("showFixedNavigation", e)
    },
    showFixedNavigationChange: function () {
        var e = this.viewState.get("showFixedNavigation");
        this.$fixedNavigation.toggleClass("visible", e), this.$navigation.toggleClass("visible", !e)
    },
    slideshowClick: function (e) {
        e.preventDefault(), this.appState.setProjectFromUrl($(e.currentTarget)
            .attr("href"))
    },
    toggleNavigationClosed: function (e) {
        e && e.preventDefault(), $(e.currentTarget)
            .closest(".internal-navigation")
            .toggleClass("closed")
    },
    getNearestSection: function (e) {
        var t = 0,
            n, r = $(window)
                .scrollTop(),
            i = $(window)
                .height();
        return _.each(this.$sections, function (e, s) {
            var o = $(e),
                u = o.offset()
                    .top,
                a = o.outerHeight(),
                f = Math.max(0, Math.min(u + a, r + i) - Math.max(u, r)) / a;
            return f >= t && (t = f, n = o), f < 1
        }, this), n.attr("id")
    },
    scroll: function () {
        if(this.viewState.get("autoScrolling")) return;
        this.viewState.set("section", this.getNearestSection())
    },
    mousewheel: function () {
        $("html, body")
            .stop(), this.viewState.set("autoScrolling", !1)
    },
    sectionChange: function (e, t) {
        var n = $("#" + t),
            r = n.find("h1")
                .text();
        this.$(".internal-navigation")
            .find("li")
            .removeClass("selected"), this.$(".internal-navigation")
            .find("a[href=#" + t + "]")
            .parent()
            .addClass("selected"), n.length && r && this.$(".internal-navigation .toggle .label")
            .text(r)
    },
    homeClick: function (e) {
        e.preventDefault(), this.viewState.set("section", null), this.animateScroll(0)
    },
    navigate: function (e) {
        e && e.preventDefault();
        var t = $(e.currentTarget.hash);
        this.$fixedNavigation.addClass("closed"), this.viewState.set("autoScrolling", !0);
        var n = t.offset()
            .top - this.$fixedNavigation.outerHeight() + 1;
        this.viewState.set("section", t.attr("id")), this.animateScroll(n)
    },
    vacanciesClick: function (e) {
        e.preventDefault(), this.animateScroll($("#vacancies")
            .offset()
            .top - this.$fixedNavigation.outerHeight())
    },
    animateScroll: function (e) {
        this.viewState.set("autoScrolling", !0);
        var t = $(document)
            .height() - $(window)
            .height();
        e = e < t ? e : t, e -= 1, $("html, body")
            .stop()
            .animate({
                scrollTop: e
            }, this.animation.duration, this.animation.easing, _.bind(function () {
                this.$fixedNavigation.css("position", "relative"), window.scroll(0, e), this.$fixedNavigation.css("position", ""), this.viewState.set("autoScrolling", !1)
            }, this))
    }
}), work.views.About = Backbone.View.extend({
    events: {
        "click .intro-text p a": "categoryClick",
        "click .project-item": "projectClick"
    },
    gridEnabled: !1,
    initialize: function (e) {
        this.appState = e.appState, this.$grid = this.$(".grid"), this.$gridItems = this.$(".grid-item"), this.$gridImages = this.$gridItems.find("img"), $(window)
            .on("resize", $.proxy(this.toggleGrid, this)), this.toggleGrid(), this.intializeFridayInspiration()
    },
    destroy: function () {
        $(window)
            .off("resize", $.proxy(this.toggleGrid, this))
    },
    categoryClick: function (e) {
        e.preventDefault(), this.appState.set({
            category: $(e.currentTarget)
                .attr("data-id"),
            projects: !0
        })
    },
    projectClick: function (e) {
        e.preventDefault(), this.appState.setProjectFromUrl($(e.currentTarget)
            .attr("href"))
    },
    toggleGrid: function () {
        var e = $(window)
            .width() < 600;
        e && this.gridEnabled && this.disableGrid(), !e && !this.gridEnabled && this.enableGrid()
    },
    enableGrid: function () {
        this.gridEnabled = !0, this.$grid.isotope({
            resizable: !1,
            transformsEnabled: !1
        }), this.$gridImages.on("load", $.proxy(this.updateGrid, this)), $(window)
            .on("resize", $.proxy(this.updateGrid, this)), this.updateGrid()
    },
    disableGrid: function () {
        this.gridEnabled = !1, this.$gridItems.width(""), this.$grid.isotope("destroy"), this.$gridImages.off("load", $.proxy(this.updateGrid, this)), $(window)
            .off("resize", $.proxy(this.updateGrid, this))
    },
    updateGrid: function () {
        if(!this.gridEnabled) return;
        var e = this.$grid.width(),
            t = 280,
            n = 125,
            r = 18,
            i = Math.min(3, Math.ceil((e - n) / (t + 1 + r * .5))),
            s = Math.max(0, e / i - r * (i - 1) / i - t) * i,
            o = s / (i - 1),
            u = r * (i - 1) + s,
            a = (e - u) / i,
            f = Math.min(a, t);
        this.$gridItems.css({
            width: f
        }), this.$grid.isotope({
            masonry: {
                columnWidth: f - 1,
                gutterWidth: r
            }
        })
    },
    intializeFridayInspiration: function () {
        var e = this.$(".friday-inspiration"),
            t = e.find(".hover"),
            n = e.find("img");
        n.css({
            top: -(n.height() - t.height()) / 2,
            left: -(n.width() - t.width()) / 2
        })
    }
}), work.views.People = Backbone.View.extend({
    events: {
        "click .person .overlay": "personClick",
        "click .vacancies .positions .position .toggle": "togglePosition"
    },
    optimalColumnWidth: 220,
    columnFlex: 140,
    initialize: function () {
        this.$container = this.$(".container"), this.$wrapper = this.$(".wrapper"), this.$people = this.$(".person"), this.$positions = this.$(".positions .position")
            .addClass("closed"), this.viewState = new Backbone.Model({
                columns: 0
            }), this.viewState.on("change:columns", this.columnsChange, this), $(window)
            .on("resize", $.proxy(this.resize, this)), $(document)
            .on("click", $.proxy(function (e) {
                $(e.target)
                    .closest(".person")
                    .length === 0 && this.close()
            }, this)), this.resize()
    },
    resize: function () {
        var e = this.$container.width(),
            t = Math.max(1, Math.ceil((e - this.columnFlex) / this.optimalColumnWidth));
        this.viewState.set("columns", t)
    },
    columnsChange: function (e, t) {
        var n = 1 / t * 100,
            r = n + "%";
        this.$people.width(r)
    },
    personClick: function (e) {
        var t = $(e.currentTarget)
            .closest(".person"),
            n = t.siblings(),
            r = !t.hasClass("active"),
            i = t.position()
                .top >= this.$wrapper.height() - t.outerHeight();
        t.removeClass("inactive")
            .toggleClass("active", r), n.removeClass("active")
            .toggleClass("inactive", r), this.$wrapper.toggleClass("move-down", r && i)
    },
    close: function () {
        this.$people.removeClass("active inactive"), this.$wrapper.removeClass("move-down")
    },
    togglePosition: function (e) {
        var t = $(e.currentTarget)
            .closest(".position"),
            n = t.hasClass("closed");
        n && this.$positions.addClass("closed"), t.toggleClass("closed", !n)
    }
}), work.views.Clients = Backbone.View.extend({
    optimalColumnWidth: 130,
    columnFlex: 0,
    gutter: 20,
    initialize: function () {
        this.$container = this.$(".container"), this.$wrapper = this.$(".wrapper"), this.$clients = this.$(".client"), this.viewState = new Backbone.Model({
            columns: 0
        }), this.viewState.on("change:columns", this.columnsChange, this), $(window)
            .on("resize", $.proxy(this.resize, this)), this.resize()
    },
    resize: function () {
        var e = this.$container.width(),
            t = Math.max(4, Math.ceil((e - this.columnFlex) / (this.optimalColumnWidth + this.gutter)));
        this.viewState.set("columns", t)
    },
    columnsChange: function (e, t) {
        var n = 1 / t * 100;
        this.$clients.width(n + "%")
    }
}), work.views.Project = Backbone.View.extend({
    events: {
        "click .photos .overlay": "overlayClick",
        "click .related .project-item, .navigate a": "projectClick",
        "click .services a": "serviceClick"
    },
    initialize: function (e) {
        _.extend(this, e), this.vent.trigger("showLogo"), this.vent.trigger("logoNavigation", "home"), this.$article = this.$(".article"), this.$processPhotos = this.$(".process-photos"), this.$photos = this.$(".photos"), this.$positioner = this.$(".photos .slideshow .positioner"), this.$overlay = this.$(".photos .overlay"), this.$overlayBackground = this.$(".photos .overlay .background"), this.$navigation = this.$(".navigate"), this.$sideNavigation = this.$navigation.filter(".side");
        var t = Modernizr.touch ? "TouchSlideshow" : "MouseSlideshow";
        this.photoSlideshow = new work.views[t]({
            el: this.$(".photos .slideshow")
        });
        var n = new work.views[t]({
            el: this.$(".process-photos .slideshow")
        }),
            r = new work.views.Share({
                el: this.$(".share")
            });
        setTimeout(_.bind(function () {
            this.previousProject = this.navigation.getPreviousProject(), this.nextProject = this.navigation.getNextProject(), this.addProjectNavigation()
        }, this), 100)
    },
    addProjectNavigation: function () {
        var e = this.$(".navigate .previous"),
            t = this.$(".navigate .next"),
            n;
        this.previousProject && (n = this.previousProject.find("a"), e.attr("href", n.attr("href"))
            .addClass("has-project")
            .find(".preview")
            .html(n.html())), this.nextProject && (n = this.nextProject.find("a"), t.attr("href", n.attr("href"))
            .addClass("has-project")
            .find(".preview")
            .html(n.html())), Modernizr.touch || $(window)
            .on("scroll resize", $.proxy(this.pinNavigation, this))
    },
    destroy: function () {
        this.photoSlideshow.off("resize", this.resizeSlideshow, this), $(window)
            .off("scroll resize", $.proxy(this.pinNavigation, this)), $(window)
            .off("mousewheel", $.proxy(this.mousewheel, this))
    },
    serviceClick: function (e) {
        e.preventDefault(), this.state.set({
            projects: !0,
            category: $(e.currentTarget)
                .attr("data-id")
        })
    },
    overlayClick: function (e) {
        e.preventDefault(), $("html, body")
            .animate({
                scrollTop: 0
            }, 800, "easeOutExpo")
    },
    projectClick: function (e) {
        e.preventDefault(), this.state.setProjectFromUrl($(e.currentTarget)
            .attr("href"))
    },
    mousewheel: function (e) {
        $("html, body")
            .stop()
    },
    pinNavigation: function () {
        var e = $(window)
            .scrollTop(),
            t = this.photoSlideshow.$el.height();
        e > t ? this.$sideNavigation.css({
            position: "fixed",
            top: Math.min(0, t + this.$article.height() - 80 - e) + 40
        }) : this.$sideNavigation.css({
            position: "",
            top: ""
        })
    }
}), work.views.Share = Backbone.View.extend({
    events: {
        "click .popup": "popupClick"
    },
    popupClick: function (e) {
        var t = e.shiftKey || e.metaKey || e.altKey;
        if(!t) {
            e.preventDefault();
            var n = $(e.currentTarget),
                r = n.attr("href"),
                i = n.attr("data-name"),
                s = n.attr("data-options");
            window.open(r, i, s)
        }
    }
}), work.views.Slideshow = Backbone.View.extend({
    options: {
        margin: .1
    },
    initialize: function (e) {
        this.$positioner = this.$(".positioner"), this.$slides = this.$positioner.find(".slide"), this.$images = this.$slides.find("img"), this.position = 0, this.sizes = this.getSizes(), this.slides = _.reduce(this.$slides, function (e, t) {
            var n = $(t),
                r = n.find("img"),
                i = this.normalize(parseInt(r.attr("width"), 10), this.sizes.total);
            return r.removeAttr("width height"), n.width(i * 100 + "%"), {
                position: e.position + i,
                slides: e.slides.concat([{
                    position: e.position,
                    width: i,
                    $el: n
                }])
            }
        }, {
            position: 0,
            slides: []
        }, this)
            .slides, $(window)
            .on("resize", _.bind(this.resize, this)), this.updatePositionerWidth(), this.$el.addClass("is-ready")
    },
    getSizes: function () {
        return _.reduce(this.$images, function (e, t) {
            var n = parseInt($(t)
                .attr("width"), 10),
                r = parseInt($(t)
                    .attr("height"), 10);
            return {
                widest: Math.max(n, e.widest),
                height: Math.max(r, e.height),
                total: e.total + n
            }
        }, {
            widest: 0,
            total: 0,
            height: 0
        })
    },
    calculateScale: function () {
        var e = this.$el.width(),
            t = e - e * this.options.margin;
        return Math.min(t / this.sizes.widest, 1)
    },
    updatePositionerWidth: function (e) {
        e = e ? e : this.calculateScale(), this.$positioner.width(this.sizes.total * e), this.scale = e
    },
    resize: function () {
        var e = this.calculateScale();
        e !== this.scale && this.updatePositionerWidth(e)
    },
    normalize: function (e, t) {
        return Math.max(0, Math.min(1, e / t))
    }
}), work.views.MouseSlideshow = work.views.Slideshow.extend({
    events: {
        "click .navigate.previous": "prev",
        "click .navigate.next": "next"
    },
    index: 0,
    easing: "easeOutExpo",
    duration: 250,
    visible: !0,
    initialize: function (e) {
        work.views.MouseSlideshow.__super__.initialize.apply(this, arguments);
        if(!this.$slides.length) return;
        this.isLinks = this.$slides.attr("href"), this.$navigate = this.$(".navigate"), $(document)
            .on("keydown", $.proxy(this.keydown, this)), $(window)
            .on("scroll", $.proxy(this.updateVisibility, this)), this.isLinks && ($(window)
                .on("resize", $.proxy(this.updateNavigationLayout, this)), this.updateNavigationLayout()), this.updateVisibility(), this.change(0)
    },
    updateNavigationLayout: function () {
        this.$navigate.width((this.$el.width() - this.$slides.eq(this.index)
            .width()) * .5)
    },
    createClones: function () {
        var e = this.$positioner.clone()
            .removeClass("positioner")
            .css("left", ""),
            t = e.clone()
                .addClass("clone before")
                .appendTo(this.$positioner),
            n = e.clone()
                .addClass("clone after")
                .appendTo(this.$positioner);
        this.$clones = t.add(n)
    },
    updatePositionerWidth: function (e) {
        work.views.MouseSlideshow.__super__.updatePositionerWidth.apply(this, arguments), this.$clones || this.createClones(), this.$clones.width(this.$positioner.width())
    },
    resize: function () {
        work.views.MouseSlideshow.__super__.resize.apply(this, arguments), this.updatePosition(this.position)
    },
    updateVisibility: function () {
        var e = $(window)
            .scrollTop(),
            t = this.$el.offset();
        this.visible = e < t.top + this.$el.height() && e + $(window)
            .height() > t.top
    },
    keydown: function (e) {
        if(!this.visible) return !0;
        e.which === 37 && this.prev(), e.which === 39 && this.next()
    },
    next: function () {
        this.change(this.index + 1, !0)
    },
    prev: function () {
        this.change(this.index - 1, !0)
    },
    change: function (e, t) {
        var n = this.wrapValue(e, this.slides.length),
            r = this.slides[n],
            i = r.position + r.width * .5,
            s = e > this.slides.length - 1,
            o = e < 0,
            u = s || o,
            a = o ? -(1 - i) : i + (s ? 1 : 0),
            f = _.bind(function () {
                this.updatePosition(i)
            }, this);
        this.updatePosition(a, t, u ? f : null), this.index = n, this.isLinks && this.updateNavigationLayout()
    },
    wrapValue: function (e, t) {
        return t = t || 1, (e % t + t) % t
    },
    getPixelPosition: function (e) {
        return -this.$positioner.width() * e + this.$el.width() * .5
    },
    updatePosition: function (e, t, n) {
        this.position = e, this.$positioner[t ? "animate" : "css"]({
            "margin-left": this.getPixelPosition(e)
        }, this.duration, this.easing, n)
    }
}), work.views.TouchSlideshow = work.views.Slideshow.extend({
    events: {
        touchstart: "touchstart"
    },
    touchTreshold: 15,
    throwForce: 7,
    initialize: function () {
        work.views.TouchSlideshow.__super__.initialize.apply(this, arguments), this.touch = {
            previousPosition: 0,
            delta: 0,
            offset: 0,
            touchOffset: 0
        }
    },
    touchstart: function (e) {
        if(e.originalEvent.touches.length !== 1) return;
        this.touch.touchOffset = e.originalEvent.touches[0].clientX, this.touch.offset = this.$positioner.translateX(), this.touch.previousPosition = this.touch.offset, this.touch.delta = 0, this.$positioner.removeClass("dropped"), $(document)
            .on("touchmove", $.proxy(this.touchmove, this)), $(document)
            .on("touchend", $.proxy(this.touchend, this))
    },
    touchmove: function (e) {
        if(e.originalEvent.touches.length !== 1) return;
        var t = e.originalEvent.touches[0].clientX,
            n = this.touch.touchOffset - t;
        if(Math.abs(n) > this.touchTreshold) {
            e.preventDefault();
            var r = n > 0 ? this.touchTreshold : -this.touchTreshold,
                i = t - this.touch.touchOffset + this.touch.offset + r;
            this.touch.delta = i - this.touch.previousPosition, this.touch.previousPosition = i, this.updatePosition(-i / (this.$positioner.width() - this.$el.width()))
        }
    },
    touchend: function (e) {
        $(document)
            .off("touchmove", $.proxy(this.touchmove, this)), $(document)
            .off("touchend", $.proxy(this.touchend, this)), this.$positioner.addClass("dropped");
        var t = -this.$positioner.translateX() - this.touch.delta * this.throwForce,
            n = this.$positioner.width() - this.$el.width();
        this.updatePosition(this.normalize(t, n)), this.$positioner.one("webkitTransitionEnd", function () {
            $(this)
                .removeClass("dropped")
        })
    },
    getPixelPosition: function (e) {
        return e * -(this.$positioner.width() - this.$el.width())
    },
    updatePosition: function (e) {
        this.position = e, this.$positioner.translateX(this.getPixelPosition(this.position))
    }
});
