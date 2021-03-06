function Segment(t, e, n) {
    this.path = t, this.length = t.getTotalLength(), this.path.style.strokeDashoffset = 2 * this.length, this.begin = e ? this.valueOf(e) : 0, this.end = n ? this.valueOf(n) : this.length, this.timer = null, this.draw(this.begin, this.end)
}
Segment.prototype = {
    draw: function(t, e, n, i) {
        if (n) {
            var s = i.hasOwnProperty("delay") ? 1e3 * parseFloat(i.delay) : 0,
                a = i.hasOwnProperty("easing") ? i.easing : null,
                h = i.hasOwnProperty("callback") ? i.callback : null,
                r = this;
            if (this.stop(), s) return delete i.delay, this.timer = setTimeout(function() {
                r.draw(t, e, n, i)
            }, s), this.timer;
            var l = new Date,
                o = 1e3 / 60,
                g = this.begin,
                f = this.end,
                u = this.valueOf(t),
                d = this.valueOf(e);
            ! function p() {
                var t = new Date,
                    e = (t - l) / 1e3,
                    i = e / parseFloat(n),
                    s = i;
                return "function" == typeof a && (s = a(s)), i > 1 ? (r.stop(), s = 1) : r.timer = setTimeout(p, o), r.begin = g + (u - g) * s, r.end = f + (d - f) * s, r.begin < 0 && (r.begin = 0), r.end > r.length && (r.end = r.length), r.begin < r.end ? r.draw(r.begin, r.end) : r.draw(r.begin + (r.end - r.begin), r.end - (r.end - r.begin)), i > 1 && "function" == typeof h ? h.call(r.context) : void 0
            }()
        } else this.path.style.strokeDasharray = this.strokeDasharray(t, e)
    },
    strokeDasharray: function(t, e) {
        return this.begin = this.valueOf(t), this.end = this.valueOf(e), [this.length, this.length + this.begin, this.end - this.begin].join(" ")
    },
    valueOf: function(t) {
        var e = parseFloat(t);
        if (("string" == typeof t || t instanceof String) && ~t.indexOf("%")) {
            var n;
            ~t.indexOf("+") ? (n = t.split("+"), e = this.percent(n[0]) + parseFloat(n[1])) : ~t.indexOf("-") ? (n = t.split("-"), e = this.percent(n[0]) - parseFloat(n[1])) : e = this.percent(t)
        }
        return e
    },
    stop: function() {
        clearTimeout(this.timer), this.timer = null
    },
    percent: function(t) {
        return parseFloat(t) / 100 * this.length
    }
};