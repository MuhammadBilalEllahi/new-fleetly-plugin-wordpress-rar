
// Function to get a cookie value by its name
function getNFPLCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

// Function to add JWT token to headers
function getNFPLAuthHeaders() {
    const token = getNFPLCookie('nfpl_jt_tok'); // Retrieve JWT from cookie
    return token ? { 'Authorization': `Bearer ${token}` } : {}; // Attach token in Authorization header if it exists
}


