const generateProductcode = (categoryCode, lastNumber = 0) => {
    const prefix = "FSH"; // Fashion Shop
    const now = new Date();

    const year = String(now.getFullYear()).slice(-2); // Last 2 digits of year
    const month = String(now.getMonth() + 1).padStart(2, "0"); // Month (01–12)
    const day = String(now.getDate()).padStart(2, "0"); // Day (01–31)

    const dateCode = `${year}${month}${day}`; // e.g. 240612

    const nextNumber = String(lastNumber + 1).padStart(3, "0"); // 001, 002, ...

    return `${prefix}-${categoryCode}-${dateCode}-${nextNumber}`;
};

export default generateProductcode;
