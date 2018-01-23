/**
 * Created by xcc on 11/11/2016.
 */

/**
 * Register the buttons
 */
function escapeHtml(text) {
    return text.replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/'/g, "'").replace(/</g, "&lt;").replace(/>/g, "&gt;");
}
(function () {
    tinymce.create('tinymce.plugins.customButton', {
        init : function(ed, url) {
            ed.addButton("btnCode", {
                title: '插入代码',
                icon: 'wp_code',
                onclick : function() {
                    ed.windowManager.open({
                        title: "插入代码",
                        body: [
                            {
                                type: 'textbox',
                                name: 'codeType',
                                label: '代码类型',
                            },
                            {
                                type: 'textbox',
                                name: 'codeContent',
                                label: '代码',
                                multiline: true,
                                minWidth: 300,
                                minHeight: 200
                            }
                        ],
                        onsubmit: function(e) {
                            ed.insertContent("<pre class='line-numbers'><code class='language-" + e.data.codeType + "'>" +  escapeHtml(e.data.codeContent) + "</code></pre>");
                        },
                    });
                }
            });
            ed.addButton("btnPanel", {
                title : '添加面板',
                text : '<面板>',
                onclick : function() {
                    ed.windowManager.open({
                        title: "添加面板",
                        body: [
                            {
                                type: 'listbox',
                                name: 'panelType',
                                label: '面板类型',
                                'values': [
                                    {text: '黄色系', value: 'warning'},
                                    {text: '红色系', value: 'forbid'},
                                    {text: '蓝色系', value: 'notice'},
                                    {text: '黑色系', value: 'geek'},
                                ]
                            },
                            {
                                type: 'textbox',
                                name: 'panelTitle',
                                label: '标题',
                            },
                            {
                                type: 'textbox',
                                name: 'panelContent',
                                label: '面板内容',
                                multiline: true,
                                minWidth: 300,
                                minHeight: 100
                            }
                        ],
                        onsubmit: function(e) {
                            ed.insertContent("<div class='panel panel-"+e.data.panelType+"'><div class='panel-title'>"+ e.data.panelTitle+"</div><div class='panel-content'>"+e.data.panelContent+"</div></div></div>");
                        },
                    });
                }
            });
            ed.addButton("btnButton", {
                title : '添加按钮',
                text : '<按钮>',
                onclick : function() {
                    ed.windowManager.open({
                        title: "添加面板",
                        body: [
                            {
                                type: 'listbox',
                                name: 'btnType',
                                label: '按钮类型',
                                'values': [
                                    {text: '黄色系', value: 'warning'},
                                    {text: '红色系', value: 'forbid'},
                                    {text: '蓝色系', value: 'notice'},
                                    {text: '黑色系', value: 'geek'},
                                ]
                            },
                            {
                                type: 'textbox',
                                name: 'btnContent',
                                label: '按钮内容',
                            },
                            {
                                type: 'textbox',
                                name: 'btnUrl',
                                label: '按钮url',
                            },
                        ],
                        onsubmit: function(e) {
                            ed.insertContent("<a target='_blank' href='"+e.data.btnUrl+"' class='btn btn-"+e.data.btnType+"'>"+e.data.btnContent+"</a>");
                        },
                    });
                }
            });
            ed.addButton("btnVideo", {
                title : '添加视频',
                text : '<视频>',
                onclick : function() {
                    ed.windowManager.open({
                        title: "添加视频",
                        body: [
                            {
                                type: 'textbox',
                                name: 'videoUrl',
                                label: '视频url',
                            },
                            {
                                type: 'textbox',
                                name: 'videoWidth',
                                label: '宽度width',
                            },
                            {
                                type: 'textbox',
                                name: 'videoHeight',
                                label: '高度height',
                            },
                        ],
                        onsubmit: function(e) {
                            ed.insertContent("<video width='"+e.data.videoWidth+"' height='"+e.data.videoHeight+"' loop='loop' controls='controls' src='" + e.data.videoUrl + "'></video>");
                        },
                    });
                }
            });
            ed.addButton("btnMusic", {
                title : '添加音乐',
                text : '<音乐>',
                onclick : function() {
                    ed.windowManager.open({
                        title: "添加音乐",
                        body: [
                            {
                                type: 'textbox',
                                name: 'musicUrl',
                                label: '音乐url',
                            },
                        ],
                        onsubmit: function(e) {
                            ed.insertContent("<audio loop='loop' controls='controls' src='" + e.data.musicUrl + "'></audio>");
                        },
                    });
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    /* Start the buttons */
    tinymce.PluginManager.add('tinymceJs', tinymce.plugins.customButton);
})();
