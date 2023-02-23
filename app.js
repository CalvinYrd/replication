function html(tag, params = null, inner = "") {
	str = `<${tag}`
	if (params) {
		for ([key, val] of Object.entries(params)) {
			val = val.replace("'", "&rsquo;")
			str += ` ${key}='${val}'`
		}
	}
	str = `${str}>${inner}</${tag}>`
	return str
}
